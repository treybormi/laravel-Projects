<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\PingURL;
use App\Models\Urls;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $links = Urls::where("status","false")->get();
        $filePath = "..\multi-purpose\public\output.txt";
        foreach ($links as $link) {
            switch ($link->scheduled) {
                case 'Every minute':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->everyMinute()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
                case 'Every hour':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->hourly()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
                case 'Every day':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->daily()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
                case 'Every week':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->weekly()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
                case 'Every month':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->monthly()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
                case 'Every quarter':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->quarterly()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
                case 'Every year':
                    $schedule->command(PingURL::class, [$link->urls])
                        ->yearly()
                        ->after(function () use ($link) {
                            $link->status = true;
                            $link->save();})
                        ->appendOutputTo($filePath);
                    break;
            }
        }
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
