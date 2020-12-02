<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;

class LogSuccessfulLogins
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
    public function handle(Login $event)
    {
        $user_id = $event->user->id;
        $agent = new Agent();
        $browser = $agent->browser();
        $desktop = $agent->isDesktop();
        if ($desktop) {
//           desktop
            $platform = $agent->platform();
            $version = $agent->version($platform);
        } else {
            //mobile
            $platform = $agent->device();
            $version = $agent->version($platform);
        }

        $today = date('d.m.Y', time());
        //insert
        //check
        $check = DB::table('login_logs')->where([
            ['user_id', '=', $user_id],
            ['good_day', '=', $today]
        ])->count();
        if ($check == 0) {
            DB::table('login_logs')->insert([
                'user_id' => $user_id,
                'device_name' => $platform,
                'version' => $version,
                'ip_addr' => Request::ip(),
                'browser_name' => $browser,
                'created_at' => Carbon::now(),
                'good_day' => $today,
            ]);
        }

    }
}
