<?php

namespace App\Providers;

use App\Callback;
use App\Comment;
use App\Doctor;
use App\Http\Resources\BootstrapTableResource;
use App\Medcenter;
use App\Observers\CallbacksObserver;
use App\Observers\CommentObserver;
use App\Observers\DoctorObserver;
use App\Observers\MedcenterObserver;
use App\Observers\OrderObserver;
use App\Observers\OrdersObserver;
use App\Observers\QuestionObserver;
use App\Observers\ServiceGroupObserver;
use App\Observers\ServiceObserver;
use App\Observers\SkillObserver;
use App\Order;
use App\Question;
use App\Service;
use App\ServiceGroup;
use App\Skill;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Observers
        Comment::observe(CommentObserver::class);
        Order::observe(OrderObserver::class);
        Doctor::observe(DoctorObserver::class);
        Medcenter::observe(MedcenterObserver::class);
        Skill::observe(SkillObserver::class);
        ServiceGroup::observe(ServiceGroupObserver::class);
        Service::observe(ServiceObserver::class);
        Question::observe(QuestionObserver::class);

        //Resources
        BootstrapTableResource::withoutWrapping();

        //Morph maps
        Relation::morphMap([
            'Doctor'    => Doctor::class,
            'Medcenter' => Medcenter::class,
            'Comment'   => Comment::class,
            'Skill'     => Skill::class,
            'Callback'  => Callback::class,
            'Order'     => Order::class
        ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
