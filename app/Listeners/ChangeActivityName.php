<?php

namespace App\Listeners;

use App\Events\Activity\BeforeSave;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeActivityName
{

    public static $priority = 9;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  BeforeSave $event
     * @return void
     */
    public function handle(BeforeSave $event)
    {
        $event->activity->name = '名字改变了';
    }
}
