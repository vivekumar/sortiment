<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
class LastLoggedIn
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //dd($event->user);
        $event->user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => request()->getClientIp()
        ]);
    }
}
