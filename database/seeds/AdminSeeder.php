<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuluminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'firstname' => 'Farook',
            'lastname' => 'Farook',
            'email' => 'ff@gmail.com',
            'magic_link' => Str::random(10)
        ]);
    }
}
