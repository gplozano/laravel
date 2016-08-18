<?php

namespace App\Handlers\Events;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\User;

class AuthLoginEventHandler
{
    /**
     * Create the event handler.
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
     * @param  Events  $event
     * @return void
     */
    //public function handle(Events $event)
    public function handle(User $user, $remember)
    {
        //
        $user->update(['last_login'=> Carbon::now()]);
    }
}
