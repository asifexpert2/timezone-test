<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\UserNotification;
use Log;

class CheckScheduledNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
{
    $notifications = UserNotification::where('scheduled_at', '<=', now())
        ->where('frequency', 'daily')
        ->get();

    foreach ($notifications as $notification) {
        Log::info("Scheduled Notification: {$notification->notification_message}");
    }
}
}
