<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishes')->insert([
            'name' => 'Motorsav',
            'url' => 'www.bauhaus.dk',
            'price' => 2000

        ]);
        DB::table('wishes')->insert([
            'name' => 'Vinglas',
            'price' => 500

        ]);
        DB::table('wishes')->insert([
            'name' => 'Høns',
            'url' => 'www.københøne.dk',
            'price' => 50

        ]);
    }
}