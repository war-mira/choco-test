<?php

namespace App\Events;

use App\Vote;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewVoteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vote;
    public $values;
    public $obj;
    public $obj_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($obj)
    {
        $this->vote = $obj->karma;
        $this->obj = strtolower(class_basename($obj));
        $this->obj_id = $obj->id;
        $this->values = $this->types($obj);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->obj.':'.$this->obj_id);
    }


    public function types($ob)
    {
        return [
            'karma'=> $ob->karma,
            'rate'=> $ob->rate,
            'likes'=> $ob->likes,
            'dislikes'=> $ob->dislikes,
        ];
    }
}
