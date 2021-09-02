<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guestState')->insert([
            'stateName' => 'Save the Date send'
        ]);
        DB::table('guestState')->insert([
            'stateName' => 'Invitation send'
        ]);
        DB::table('guestState')->insert([
            'stateName' => 'Not Attending'
        ]);
        DB::table('guestState')->insert([
            'stateName' => 'Attending'
        ]);
    }
}