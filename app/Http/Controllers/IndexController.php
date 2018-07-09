<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Doctor;
use App\Helpers\SessionContext;
use App\Models\District;
use App\Order;
use App\Post;
use App\Skill;
use DB;

class IndexController extends Controller
{
    public function home()
    {
        $topDoctors = Doctor::where('on_top', '=', 1)->where('status', '=', 1)->get();

        $topPosts = Post::where('is_top', 1)->where('status', 1)->orderBy('created_at', 'desc')->limit(3)->get();

        //Специальности по количесвам врачей
        $skillLinks = Skill::query()
            ->with(['doctors' => function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            }])
            ->withCount(['doctors' => function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            }])
            ->whereHas('doctors', function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            })
            ->orderBy('name')
            ->get()
            ->map(function ($skill) {
                $name = $skill->name;
                $doctorsCount = $skill->doctors_count;
                $href = $skill->href;
                return compact('name', 'href', 'doctorsCount');
            });

        //Комментарии
        $lastComments = Comment::whereStatus(1)->orderByDesc('created_at')->take(20)->get();

        $title = 'iDoctor.kz - Поиск врача в Алматы и Астане, бесплатная запись на прием';
        $description = 'iDoctor.kz - Сервис для поиска врача и бесплатной записи на прием. Мы собрали базу врачей в Алматы и Астане с рейтингами и отзывами наших клиентов.';
        $meta = compact('title', 'description');

        return view('index')->with(
            compact(
                'meta',
                'topDoctors',
                'topPosts',
                'skillLinks',
                'lastComments')
        );
    }

    public function r_home()
    {
        $stats = [
            'doctors_count'  => Doctor::localPublic()->count(),
            'orders_count'   => Order::whereIn('status', [1, 2])->count(),
            'comments_count' => Comment::count()
        ];

        $social = [
            'fb'    => 'https://www.facebook.com/kz.idoctor',
            'insta' => 'https://www.instagram.com/idoctor_kz/',
            'vk'    => 'https://vk.com/idoctorkz1',
        ];

        $topDoctors = Doctor::where('on_top', '=', 1)->where('status', '=', 1)->get();

        $topPosts = Post::where('is_top', 1)->where('status', 1)->orderBy('date_create', 'desc')->limit(3)->get();

        //Специальности по количесвам врачей
        $skillsList = Skill::query()
            ->with(['doctors' => function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            }])
            ->withCount(['doctors' => function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            }])
            ->whereHas('doctors', function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            })
            ->orderBy('name')
            ->get()
            ->map(function ($skill) {
                $name = $skill->name;
                $doctorsCount = $skill->doctors_count;
                $href = route('doctors.searchPage', ['skill' => $skill->id]);
                return compact('name', 'href', 'doctorsCount');
            });

        $districts = District::all();

        //Комментарии
        $topPromotions = collect([]);

        $title = 'iDoctor.kz - Поиск врача в Алматы и Астане, бесплатная запись на прием';
        $description = 'iDoctor.kz - Сервис для поиска врача и бесплатной записи на прием. Мы собрали базу врачей в Алматы и Астане с рейтингами и отзывами наших клиентов.';
        $meta = compact('title', 'description');

        return view('redesign.index')->with(
            compact(
                'meta',
                'topDoctors',
                'topPosts',
                'topPromotions',
                'skillsList',
                'stats',
                'social',
                'districts')
        );
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
}
