<?php

namespace App\Models\Doctors\Traits\Method;

use App\Helpers\MathHelper;
use App\Models\Doctors\DoctorJob;

/**
 * Trait DoctorMethod
 * @package App\Models\Doctors\Traits\Method
 */
trait DoctorMethod
{
    /**
     * @return void
     */
    public function updateCommentRate()
    {
        $comments = $this->publicComments()->get();
        $sumRate = $comments->sum('author_rate');
        $countRate = $comments->count();
        $avgRate = $countRate <= 0 ? 0 : $sumRate / $countRate;
        $rate = MathHelper::wilsonScore($sumRate, $countRate);
        $this->rate = $rate / 2;
        $this->avg_rate = $avgRate / 2;
        $this->save();
    }

    /**
     * @return mixed
     */
    public function publicComments()
    {
        return $this->comments()->where('comments.status', 1)->orderBy('updated_at', 'desc');
    }

    /**
     * @return mixed
     */
    public function jobsTimetable()
    {
        return $this->jobs()->get()->map(function (DoctorJob $job) {
            return $job->append('week_timetable')->makeHidden('timetable');
        })->toArray();
    }
}
