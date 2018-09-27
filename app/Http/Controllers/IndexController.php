<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Components\ToastrNotification;
use App\Doctor;
use App\Helpers\SeoMetadataHelper;
use App\Helpers\SessionContext;
use App\Models\District;
use App\Order;
use App\PageSeo;
use App\Post;
use App\Skill;
use App\Uniqueip;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function home()
    {

        ToastrNotification::push('Hello');
        ToastrNotification::push('Hello!!!');
        if (Cache::has('index:skills'))
            $stats = Cache::get('index:stats');
        else {
            $stats = [
                'doctors_count' => Doctor::localPublic()->count(),
                'orders_count' => Order::whereIn('status', [1, 2])->count(),
                'comments_count' => Comment::count()
            ];

            Cache::set('index:stats', $stats, 30);
        }


        $social = [
            'fb' => 'https://www.facebook.com/kz.idoctor',
            'insta' => 'https://www.instagram.com/idoctor_kz/',
            'vk' => 'https://vk.com/idoctorkz1',
        ];

//        $topDoctors = Doctor::where('on_top', '=', 1)->where('status', '=', 1)->get();

        if (Cache::has('index:topPosts'))
            $topPosts = Cache::get('index:topPosts');
        else {
            $topPosts = Post::where('is_top', 1)->where('status', 1)->orderBy('created_at', 'desc')->limit(3)->get();
            Cache::set('index:topPosts', $topPosts, 120);
        }


        $answered_questions = \App\Question::wherehas('answers')->count();
        $questions = \App\Question::take(4)
            ->orderBy('created_at', 'desc')
            ->whereHas('answers')
            ->get();


        //Специальности по количесвам врачей
        $skillsList = Cache::remember('index:skills-'. SessionContext::cityId(),120,function(){
            return Skill::query()
                ->withCount(['doctors as doctorsCount' => function ($query) {
                    $query->where('status', 1)->where('city_id', SessionContext::cityId());
                }])
                ->whereHas('doctors', function ($query) {
                    $query->where('status', 1)->where('city_id', SessionContext::cityId());
                })
                ->orderBy('name')
                ->get(['name', 'href', 'doctorsCount']);

        });


        if (Cache::has('index:districts'))
            $districts = Cache::get('index:districts');
        else {
            $districts = District::all();
            Cache::set('index:districts', $topPosts, 120);
        }


        //Комментарии
        $topPromotions = collect([]);

        $pageSeo = PageSeo::query()
            ->where('class', 'Home')
            ->where('action', 'index')
            ->first();
        $meta = SeoMetadataHelper::getMeta($pageSeo, SessionContext::city());

        return view('redesign.index')->with(
            compact(
                'meta',
                'topDoctors',
                'topPosts',
                'topPromotions',
                'skillsList',
                'stats',
                'social',
                'districts',
                'answered_questions',
                'questions')
        );
    }

    public function ratings(Request $request)
    {
        $like = $request->get('likenot');
        $doc = $request->get('doc');
        $ip = $request->ip();
        $status = null;

        if (!Uniqueip::where('ip', '=', $ip)->where('doctor', '=', $doc)->count()) {
            $cf = new Uniqueip();
            $cf->doctor = $doc;
            $cf->ip = $ip;
            $cf->like_dis = $like;
            $cf->save();

            $doctor = Doctor::where('id', '=', $doc)->first();
            if ($like == 1) {
                $doctor->like += 1;
            } else {
                $doctor->dislike += 1;
            }
            $doctor->save();
        }

        return response()->json([
            'status' => $status,
            'rates' => view('components.ratemini', ['doctor' => $doctor])->render()
        ]);
    }

    public function getBuyersReport()
    {
        $years = array('2013', '2014', '2015', '2016', '2017');
        $current_month = date('m');
        $monthes = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $dates = array();

        foreach ($years as $year) {
            foreach ($monthes as $month) {
                $dates[] = $year . '-' . $month . '-01';
                if ($year == "2017" && $month == $current_month) break;
            }
        }

        $user_phones = $date_terms = [];

        $i = 0;

        foreach ($dates as $date) {

            $user_phones_by_period = DB::select("
            SELECT DISTINCT o.phone
			FROM orders o
			WHERE o.status IN(1,2) AND (o.phone LIKE '8%' OR o.phone LIKE '7%' OR o.phone LIKE '+7%')
			AND DATE(FROM_UNIXTIME(o.date_create))<'" . $date . "'
			AND DATE(FROM_UNIXTIME(o.date_create))>=DATE_SUB('" . $date . "', INTERVAL 2 YEAR)
        ");

            $user_phones_by_period = array_map(function ($value) {
                return $value->phone;
            }, $user_phones_by_period);

            $user_phones[$i] = $user_phones_by_period;
            $date_terms['date'][$i] = $date;

            $i++;
        }

        $cout = '
    <table border="1" cellspacing="0">
    <tr>
        <td>Месяц</td>
        <td># покупателей на начало</td>
        <td># новых покупателей за месяц</td>
        <td># убыло покупателей за месяц (24)</td>
        <td># покупателей на конец</td>
        <td># заказов от новых покупателей</td>
        <td># заказов от старых покупателей</td>
    </tr>';

        // смотрим данные на 1 число каждого месяца
        foreach ($user_phones as $key => $ids) {
            $cout .= '
			<tr>
				<td>' . $date_terms['date'][$key] . '</td>';

            $users_at_the_beginning = $ids;
            $users_at_the_beginning_count = count($users_at_the_beginning);
            $users_at_the_beginning_orders_count = 0;

            if ($users_at_the_beginning_count) {
                $users_at_the_beginning_orders_count = DB::table('orders')
                    ->whereIn('status', [1, 2])
                    ->whereIn('phone', $users_at_the_beginning)
                    ->whereRaw('DATE(FROM_UNIXTIME(date_create)) < "' . $date_terms['date'][$key] . '"')
                    ->whereRaw('DATE(FROM_UNIXTIME(date_create)) >= DATE_SUB("' . $date_terms['date'][$key] . '", INTERVAL 1 MONTH)')
                    ->count();
            }

            if ($date_terms['date'][$key] != "2017-" . $current_month . "-01") {
                // кол-во пересечений пользователей между текущим списком и списком в следующем месяце
                $users_of_intersection = count(array_intersect($ids, $user_phones[$key + 1]));

                // кол-во новых пользователей
                $users_new = array_diff($user_phones[$key + 1], $ids);
                $users_new_count = count($users_new);
                $users_new_orders_count = 0;

                if ($users_new_count) {
                    $users_new_orders_count = DB::table('orders')
                        ->whereIn('status', [1, 2])
                        ->whereIn('phone', $users_new)
                        ->whereRaw('DATE(FROM_UNIXTIME(date_create)) < "' . $date_terms['date'][$key + 1] . '"')
                        ->whereRaw('DATE(FROM_UNIXTIME(date_create)) >= DATE_SUB("' . $date_terms['date'][$key + 1] . '", INTERVAL 1 MONTH)')
                        ->count();
                }


                // кол-во пользователей в конце месяца
                $users_at_the_end = $user_phones[$key + 1];
                $users_at_the_end_count = count($users_at_the_end);

                // кол-во пользователей, которые были в старом списке, но нет в текущем
                $users_lost = array_diff($ids, $user_phones[$key + 1]);
                $users_lost_count = count($users_lost);

            } else {
                $users_of_intersection = 0;
                $users_new_count = 0;
                $users_at_the_end_count = 0;
                $users_lost_count = 0;
                $users_new_orders_count = 0;
            }

            $cout .= '<td>' . $users_at_the_beginning_count . '</td>' .
                '<td>' . $users_new_count . '</td>' .
                '<td>' . $users_lost_count . '</td>' .
                '<td>' . $users_at_the_end_count . '</td>' .
                '<td>' . $users_new_orders_count . '</td>' .
                '<td>' . $users_at_the_beginning_orders_count . '</td>';


            $cout .= '</tr>';
        }

        $cout .= '</tr></table>';

        echo $cout;
    }

    public function testCurl()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://geocode-maps.yandex.ru/1.x/?format=json&geocode=ул. Тайманова  блок 1');
        $stream = $response->getBody();
        dd($stream->getContents());
    }
}
