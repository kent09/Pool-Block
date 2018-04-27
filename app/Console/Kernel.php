<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        
        \App\Console\Commands\NewNetworks::class,
        \App\Console\Commands\NewThiryDaysNetwork::class,
        \App\Console\Commands\NewBlocksPool::class,
        \App\Console\Commands\Minandoandos::class,
        \App\Console\Commands\Cryptomineros::class,
        // \App\Console\Commands\TotalBlocksNetwork::class,
        // \App\Console\Commands\TotalBlocksPool::class,
        // \App\Console\Commands\ThiryDaysNetwork::class,
    ];
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $ts = date('Y-m-d-H-i-s');

        $schedule->command('new:network')->cron('*/5 * * * *')->sendOutputTo(storage_path('logs/new-network-'.$ts.'.log'));
        $schedule->command('new:blockspool')->cron('*/5 * * * *')->sendOutputTo(storage_path('logs/new-blockspool-'.$ts.'.log'));
        $schedule->command('minandoando:blockspool')->cron('*/5 * * * *')->sendOutputTo(storage_path('logs/new-minandoando-'.$ts.'.log'));
        $schedule->command('cryptomineros:blockspool')->cron('*/5 * * * *')->sendOutputTo(storage_path('logs/new-cryptomineros-'.$ts.'.log'));
        $schedule->command('new:thirydays')->cron('*/10 * * * *')->sendOutputTo(storage_path('logs/new-thirydays-'.$ts.'.log'));
        

        // $schedule->command('blocks:network')->everyMinute()->sendOutputTo(storage_path('logs/blocks-network-'.$ts.'.log'));
        // $schedule->command('blocks:pool')->everyMinute()->sendOutputTo(storage_path('logs/blocks-pool-'.$ts.'.log'));
        // $schedule->command('thirydays:network')->everyMinute()->sendOutputTo(storage_path('logs/thirydays-network-'.$ts.'.log'));
        
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
