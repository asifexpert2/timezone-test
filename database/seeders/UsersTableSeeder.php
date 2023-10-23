<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $timezones = ['America/New_York', 'Asia/Tokyo', 'Asia/Karachi', 'Asia/Dhaka', 'America/Anguilla', 'Europe/Amsterdam', 'Europe/Berlin', 'Europe/Budapest', 'Europe/Dublin', 'Europe/London', 'Europe/Oslo', 'Europe/Paris', 'Europe/Rome', 'Europe/Vienna', 'Asia/Riyadh'];

        foreach (range(1, 20) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('appiskey'),
                'timezone' => $faker->randomElement($timezones),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
