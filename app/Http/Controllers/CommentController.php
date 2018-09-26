<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Helpers\FormatHelper;
use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    protected $model = Comment::class;
    protected $relationFields = ['owner', 'replies'];
    protected $deafaultFields = [
        'status' => 0
    ];
    protected $searchFields = ['text'];
    protected $identities = false;

    public function getTableView(Request $request)
    {
        $tableName = 'Отзывы';
        $url = route('admin.comment.crud.get');
        $form = route('admin.comment.form');
        return view('admin.table.comments', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Comment::find($id);
        $params = ['redirect' => 'admin.comment.form'];
        if ($id != null)
            $params['id'] = $id;
        $action = route('admin.comment.crud.' . ($id == null ? 'create' : 'update'), $params);
        return view('forms.admin.comment', compact('seed', 'action'));
    }

    public function new(Request $request)
    {
        $data = $request->all();
        $user = \Auth::user();
        if ($user) {
            $data['user_email'] = $user->phone;
            $data['user_name'] = $user->name;
            $data['author_id'] = $user->id;
        }else{
            $code = random_int(1000,9999);
            $hash = md5($code);
            $phone = FormatHelper::phone($data['user_email']);
            Redis::set('doctor-vote:'.$code.':'.$hash.':dump-form',json_encode($data));
            Redis::expire('doctor-vote:'.$code.':'.$hash.':dump-form',120);

            // TODO send sms code
            Redis::publish('debug-sms',$code);
            Redis::publish('debug-sms',$phone);

            //TODO: throttle sms delivery for 1 min for number
            $sms = \SmsService::send([
                'recipient' => $phone,
                'text'      => 'iDoctor код - ' . $code
            ]);
            if (!$sms)
                return ['error'=>'На указанный номер не удалось отправить СМС!'];

            return ['code'=>$hash];
        }

        return $this->publishNewComment($data);
    }


    public function confirmPhone(Request $request)
    {
        if(!$request->has('code'))
            return ['error'=>'Введите код из СМС!'];

        $key = Redis::keys('doctor-vote:'.$request->code.':*:dump-form');

        if(count($key)>0)
            $data = (array) json_decode(Redis::get($key[0]));

        if(isset($data))
            return $this->publishNewComment($data);

        return ['error'=>'Введен не действительный код'];
    }


    public function requestPhoneCode(Request $request)
    {
        return ['status'=>'sent'];
    }


    public function publishNewComment($data)
    {
        $data['user_email'] = isset($data['user_email']) ? FormatHelper::phone($data['user_email']):'';
        $authorize = $this->authorizeComment($data);
        $ip = $this->getUserIp();

        if($ip){
            $data['user_ip'] = ip2long($ip);
        }
        $existCommentsCount = $this->existCommentsFromPhone($data['user_email'], $data['owner_id']);

        if($existCommentsCount > 0)
            return ['error' => 'Вы уже оставляли отзыв этому врачу.'];

        if($authorize > 0)
            $data['type'] = Comment::typeQR;

//        if(isset($data['type'])) {
//            if ($authorize <= 0 && $data['type'] != Comment::typeQR)
//                return ['error' => 'Комментарий можно оставлять только после посещения врача! Если вы уже посетили врача,'
//                    . ' то проверьте совпадает ли номер телефона с использовавшимся при записи.'];
//        }

        $data['text'] = strip_tags($data['text'] ?? "");
        $comment = Comment::create($data);
//        $comment->created_at = Carbon::now()->timestamp;
//        $comment->updated_at = Carbon::now()->timestamp;
//        $comment->save();
        return $comment;
    }







    private function authorizeComment($data)
    {
        $phone = $data['user_email'];
        $orders = Order::whereIn('status', [1, 2])->where(function (Builder $query) use ($phone) {
            $query->where('phone', $phone);
            $query->orWhereHas('client', function (Builder $clientQuery) use ($phone) {
                $clientQuery->where('phone', $phone);
            });
        });
        
        if ($data['owner_type'] == 'Doctor')
            $orders->where('doc_id', $data['owner_id']);

        $authorize = $orders->count() > 0;

        return $authorize;
    }

    private function getUserIp(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    private function existCommentsFromIp($ip, $doctorId){
        $comments = Comment::where('owner_id', $doctorId)->where('user_ip', $ip)->count();

        return$comments;
    }
    private function existCommentsFromPhone($phone, $doctorId){
        $comments = Comment::where('owner_id', $doctorId)->where('user_email', $phone)->count();

        return$comments;
    }

    public function list(Request $request, $type = 'allow')
    {
        if ($request->method() == 'post') {
            $text = $request->input('reply_text');
        }
        if ($type == 'allow') {
            $comments = Comment::where('status', 1)->orderBy('created_at', 'DESC')->paginate(15);
        } else {
            $comments = Comment::where('status', 0)->orderBy('created_at', 'DESC')->paginate(15);
        }
        return view('admin.comments.main')->with(compact('comments', 'type', 'activeLink'));
    }

    public function set_status(Request $request)
    {
        $Input = $request->all();
        $Comment = Comment::find($Input['comment']);
        $Comment->status = $Input['status'];
        $Comment->save();
        return $Comment;
    }

    public function reply(\Illuminate\Http\Request $request, $id)
    {
        $returnUrl = $request->input('return', route('admin.comment.list'));
        $text = $request->input('text');

        Comment::find($id)->replies()->create([
            'user_rate'  => 10,
            'user_name'  => 'iDoctor',
            'user_email' => 'idoctor.kz',
            'text'       => $text,
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp
        ]);
        return redirect()->back();
    }

    public function delete(\Illuminate\Http\Request $request, $id)
    {
        Comment::find($id)->delete();
        return redirect()->back();
    }

    public function rateComment($id, $rate)
    {
        if (\Auth::guest())
            return response('Authorization required!', 403);
        $rate = $rate == 'up' ? 1 : -1;
        $comment = Comment::find($id);
        $user = \Auth::user();

        $rateData = [
            'comment_id' => $id,
            'user_id'    => $user->id,
            'rate'       => $rate
        ];

        $rates = $user->rates()->where('comment_id', $id)->get();
        if ($rates->count() > 0) {
            $rate = $rates->first();
            if ($rateData['rate'] == $rate['rate'])
                $rateData['rate'] = 0;
            $rate->update($rateData);
        } else
            $rate = $comment->rates()->create($rateData);
        return ['up' => $comment->rates()->up()->count(), 'down' => $comment->rates()->down()->count()];

    }


}
