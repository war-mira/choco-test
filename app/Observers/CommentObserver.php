<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.11.2017
 * Time: 12:14
 */

namespace App\Observers;


use App\Doctor;
use App\Medcenter;

class CommentObserver
{
    public function created($comment)
    {
        $this->updateCommentRate($comment);
    }

    public function updated($comment)
    {
        $this->updateCommentRate($comment);
    }

    private function updateCommentRate($comment)
    {
        $owner = $comment->owner;
        if ($owner instanceof Medcenter)
            $owner->updateCommentRate();
        elseif ($owner instanceof Doctor) {
            $owner->updateCommentRate();
            $owner->medcenters()->get()->each(function ($medcenter) {
                /** @var Medcenter $medcenter */
                $medcenter->updateCommentRate();
            });
        }
    }
}