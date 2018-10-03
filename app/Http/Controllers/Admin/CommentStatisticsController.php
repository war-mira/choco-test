<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentStatisticsController extends Controller
{
    public static function wrap($results, $total)
    {
        return ['total' => $total,
            'rows' => $results];
    }

    public function skillComments()
    {
        $query = Comment::query()
            ->where('owner_type', 'Doctor')
            ->with('owner', function ($ownerQuery) {
                $ownerQuery->with('skills');
            })->groupBy('skills.id')->get();

    }


    public function tableData(Request $request)
    {
        $search = $request->input('search', null);
        $filter = $request->input('filter', []);
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);


        $query = Skill::with(['doctors']);
        foreach ($filter as $filterTuple) {
            $column = $filterTuple[0];
            $operator = $filterTuple[1];
            $value = $filterTuple[2];
            if ($operator == 'between') {
                if (count($value) == 2)
                    $query = $query->whereBetween($column, $value);
            } elseif ($operator == 'in') {
                if (count($value) > 0)
                    $query = $query->whereIn($column, $value);
            } else
                $query = $query->where($column, $operator, $value);

        }
        if ($search !== null) {
            $query = $query->where(function ($query) use ($search) {
                foreach ($this->searchFields as $index => $searchField) {
                    if (!is_numeric($index))
                        $query = $query->orWhereHas($index, function ($q) use ($searchField, $search) {
                            $q->where($searchField, 'like', '%' . $search . '%');
                        });
                    else
                        $query = $query->orWhere($searchField, 'like', '%' . $search . '%');
                }
            });
        }
        $total = $query->count();
        $objects = $query->orderBy($sort, $order)
            ->offset($offset)
            ->limit($limit)
            ->get(['id'])->toArray();

        $result = self::wrap($objects, $total);
        return $result;
    }

    public function allStatistics(Request $request)
    {
        $start = $request->input('start', false);
        $end = $request->input('end', false);

        $start = $start ? Carbon::createFromFormat('Y-m-d H:i', $start) : Carbon::yesterday()->setTime(19, 0);
        $end = $end ? Carbon::createFromFormat('Y-m-d H:i', $end) : Carbon::today()->setTime(19, 0);

        $query = Comment::query()
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw(
                'comments.status,'
                . 'count(comments.id) as total,'
                . 'avg(comments.user_rate) as avg'
            );

        $all = (clone $query)->first();
        $all['name'] = 'Все';

        $statistics = $query->groupBy('comments.status')->get()->map(function ($stat) {
            $stat['name'] = Comment::STATUS[$stat['status']];
            return $stat;
        });

        $statistics->prepend($all);

        return view('admin.model.comments.statistics.all', compact('start', 'end', 'statistics'));
    }

    public function commentsByMedcenters(Request $request)
    {
        if (!$request->ajax()) {
            $tableName = 'Отзывы по медцентрам';
            $url = route('admin.comments.statistics.medcenters');
            $form = route('admin.comments.statistics.medcenters');
            return view('admin.model.comments.statistics.medcenters', compact('url', 'form', 'tableName'));
        } else {

            $statisticsQuery = Comment::query()
                //->whereBetween('created_at', [$from, $to])
                ->where('owner_type', 'Doctor')
                ->join('doctors', 'doctors.id', '=', 'comments.owner_id')
                ->join('doctor_jobs', 'doctor_jobs.doctor_id', '=', 'doctors.id')
                ->rightJoin('medcenters', 'medcenters.id', '=', 'doctor_jobs.medcenter_id')
                ->selectRaw(
                    'count(comments.id) as comments_count,'
                    . 'sum(comments.status!=1) as closed_comments_count,'
                    . 'sum(comments.status=1) as open_comments_count,'
                    . 'sum(comments.user_rate >= 0 and comments.user_rate <= 2) as 0_2_comments_count,'
                    . 'sum(comments.user_rate > 2 and comments.user_rate <= 4) as 2_4_comments_count,'
                    . 'sum(comments.user_rate > 4 and comments.user_rate <= 6) as 4_6_comments_count,'
                    . 'sum(comments.user_rate > 6 and comments.user_rate <= 8) as 6_8_comments_count,'
                    . 'sum(comments.user_rate > 8 and comments.user_rate <= 10) as 8_10_comments_count,'
                    . 'avg(comments.user_rate) as avg_rate,'
                    . 'medcenters.id,'
                    . 'medcenters.name')
                ->groupBy(['medcenters.id']);
            return BootstrapTableHelper::processTableRequest($request, $statisticsQuery, ['name']);
        }
    }



    public function commentsByDoctors(Request $request)
    {
        if (!$request->ajax()) {
            $tableName = 'Отзывы по врачам';
            $url = route('admin.comments.statistics.doctors');
            $form = route('admin.comments.statistics.doctors');
            return view('admin.model.comments.statistics.doctors', compact('url', 'form', 'tableName'));
        } else {

            $statisticsQuery = Comment::query()
                //->whereBetween('created_at', [$from, $to])
                ->where('owner_type', 'Doctor')
                ->join('doctors', 'doctors.id', '=', 'comments.owner_id')
                ->join('doctors_skills', 'doctors_skills.doctor_id', '=', 'doctors.id')
                ->rightJoin('skills', 'skills.id', '=', 'doctors_skills.skill_id')
                ->selectRaw(
                    'count(comments.id) as comments_count,'
                    . 'sum(comments.status!=1) as closed_comments_count,'
                    . 'sum(comments.status=1) as open_comments_count,'
                    . 'sum(comments.user_rate >= 0 and comments.user_rate <= 2) as 0_2_comments_count,'
                    . 'sum(comments.user_rate > 2 and comments.user_rate <= 4) as 2_4_comments_count,'
                    . 'sum(comments.user_rate > 4 and comments.user_rate <= 6) as 4_6_comments_count,'
                    . 'sum(comments.user_rate > 6 and comments.user_rate <= 8) as 6_8_comments_count,'
                    . 'sum(comments.user_rate > 8 and comments.user_rate <= 10) as 8_10_comments_count,'
                    . 'avg(comments.user_rate) as avg_rate,'
                    . 'doctors.id,'
                    . 'doctors.lastname,'
                    . 'doctors.firstname')
                ->groupBy(['doctors.id']);
            return BootstrapTableHelper::processTableRequest($request, $statisticsQuery, ['lastname', 'firstname']);
        }
    }

    public function commentsBySkills(Request $request)
    {
        if (!$request->ajax()) {
            $tableName = 'Отзывы по специализациям';
            $url = route('admin.comments.statistics.skills');
            $form = route('admin.comments.statistics.skills');
            return view('admin.model.comments.statistics.skills', compact('url', 'form', 'tableName'));
        } else {

            $statisticsQuery = Comment::query()
                //->whereBetween('created_at', [$from, $to])
                ->where('owner_type', 'Doctor')
                ->join('doctors', 'doctors.id', '=', 'comments.owner_id')
                ->join('doctors_skills', 'doctors_skills.doctor_id', '=', 'doctors.id')
                ->rightJoin('skills', 'skills.id', '=', 'doctors_skills.skill_id')
                ->selectRaw(
                    'count(comments.id) as comments_count,'
                    . 'sum(comments.status!=1) as closed_comments_count,'
                    . 'sum(comments.status=1) as open_comments_count,'
                    . 'sum(comments.user_rate >= 0 and comments.user_rate <= 2) as 0_2_comments_count,'
                    . 'sum(comments.user_rate > 2 and comments.user_rate <= 4) as 2_4_comments_count,'
                    . 'sum(comments.user_rate > 4 and comments.user_rate <= 6) as 4_6_comments_count,'
                    . 'sum(comments.user_rate > 6 and comments.user_rate <= 8) as 6_8_comments_count,'
                    . 'sum(comments.user_rate > 8 and comments.user_rate <= 10) as 8_10_comments_count,'
                    . 'avg(comments.user_rate) as avg_rate,'
                    . 'skills.id,'
                    . 'skills.name')
                ->groupBy(['skills.id']);
            return BootstrapTableHelper::processTableRequest($request, $statisticsQuery, ['name']);
        }
    }

    public function view(Request $request)
    {
        return view('admin.comments.tabs.stats', ['tableUrl' => route('admin.comment.statisticsTableData')]);
    }
}
