<?php

namespace App\Providers;

use App\Events\NewCompanyHasRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\WelcomeNewCompanyListener;
use App\Listeners\RegisterCompanyToNewsLetter;
use App\Listeners\NotifyAdminViaSlack;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewCompanyHasRegistered::class => [
            WelcomeNewCompanyListener::class,
            //these tow Listener i think must implement
            // use php artisan generate command to make these two automatic
            RegisterCompanyToNewsLetter::class, //add company email to our news letter
            NotifyAdminViaSlack::class, // notify to super administrator when new company add to system
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
