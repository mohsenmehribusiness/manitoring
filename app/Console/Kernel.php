<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
Use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function ()
        {
            /*schedule*/


            //function protected
            function get_http_response_code($domain1)
            {
                $headers = get_headers($domain1);
                return substr($headers[0], 9, 3);
            }
            //function protected

            //all monitors get
            $monitors=\App\monitor::all();
            //all monitors get
            //save all HTTP code status monitors
            foreach ($monitors as $monitor)
            {
                //check time
                $length_time=intval((time() - strtotime($monitor->created_at)) / 60);
                $t1=$length_time/$monitor->time;
                $time=floatval($t1)-intval($t1);
                //check time
                //save
                if($time==0)
                {
                    $monitoring = new \App\monitoring();
                    $monitoring->HTTP = get_http_response_code($monitor->URL);
                    $monitoring->monitors_id = $monitor->id;
                    $monitoring->save();
                }
                //save
            }
            //save all HTTP code status monitors
            /*schedule*/
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
