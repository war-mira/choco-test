<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DoctorReviewsWeeklyMail extends Mailable
{
    use Queueable, SerializesModels;


    public $reviews;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $reviews)
    {
        $this->reviews = $reviews;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $count = $this->reviews->count();
        $name = $this->name;
        return $this->subject('Ваши отзывы за неделю')
                    ->view('mail.doctor_reviews_weekly',compact('count','name'));
    }
}
