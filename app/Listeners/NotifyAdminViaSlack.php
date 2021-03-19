<?php

namespace App\Listeners;

use App\Events\NewCompanyHasRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminViaSlack
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewCompanyHasRegistered  $event
     * @return void
     */
    public function handle(NewCompanyHasRegistered $event)
    {
//        dump('slack message here');
    }
}
