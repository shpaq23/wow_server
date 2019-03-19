<?php

use Illuminate\Database\Seeder;
use App\RegisterPassword;

class RegisterPasswordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegisterPassword::truncate();

        RegisterPassword::create([
            'password' => str_random(60),
        ]);
    }
}
