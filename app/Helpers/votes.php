<?php


namespace App\Helpers;


use App\Events\NewVoteEvent;
use App\Vote;
use Illuminate\Support\Facades\Auth;

trait votes {



    public function votes()
    {
        return $this->morphMany(Vote::class,'obj');
    }

    public function getKarmaAttribute()
    {
        return $this->votes()->sum('mark');
    }

    public function getRateAttribute()
    {
        return $this->votes()->avg('mark');
    }
    public function getLikesAttribute()
    {
        return $this->votes()->where('mark','>',0)->count();
    }

    public function getDislikesAttribute()
    {
        return $this->votes()->where('mark','<',0)->count();
    }

    public function getVoteTypeAttribute()
    {
        return 'karma';
    }

    public function vote($mark = 1, $user_id = null)
    {

        $vote = $this->votes()->UpdateOrCreate([
            'user_id'=> ($user_id?:Auth::user()->id)
        ],['mark'=>$mark]);
        event(new NewVoteEvent($this));

        return $vote;
    }

}
