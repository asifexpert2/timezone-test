<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use DB;

class UserNotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $users = DB::table('users')->get();
        
        foreach (range(1, 20) as $index) {
            $user = $faker->randomElement($users);
            $scheduled_at = $faker->time('H:i');

            $userTimezone = $user->timezone;
            $scheduledTime = Carbon::createFromFormat('H:i', $scheduled_at, 'UTC')
                ->setTimezone($userTimezone)
                ->format('H:i');

            $frequency = $faker->randomElement(['daily', 'weekly', 'monthly', 'custom']);

            $msg = "Hello {$user->name},\n";
            $msg .= "This is a notification for you. Your email address is: {$user->email}.\n";
            $msg .= "You have a scheduled event at {$scheduledTime} in your local timezone.\n";
            $msg .= "Thank you for using our notification system.\n";
            $msg .= "Best regards,\n[Your Company Name]";

            DB::table('user_notifications')->insert([
                'user_id' => $user->id,
                'scheduled_at' => $scheduledTime,
                'frequency' => $frequency,
                'notification_message' => $msg,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
