<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.01.2018
 * Time: 11:42
 */

namespace App\Observers;


use App\Doctor;
use App\Question;
use App\Traits\Observers\Slug;

class QuestionObserver
{
    use Slug;

    public function updated(Question $question)
    {
        $this->invalidateCache();
    }
    public function created(Question $question)
    {
        $this->invalidateCache();
    }
    public function saved(Question $question)
    {
        $this->invalidateCache();
    }
    public function invalidateCache()
    {
        \Cache::tags(['questions'])->flush();
    }
}