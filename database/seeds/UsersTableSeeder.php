<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $password = Hash::make('kutas321');


        User::create([
            'first_name' => 'Michał',
            'last_name' => 'Szpak',
            'email' => 'shpaq23@gmail.com',
            'password' => $password,
            'type' => 'admin'
        ]);
        User::create([
            'first_name' => 'Zuzanna',
            'last_name' => 'Olszewska',
            'email' => 'zuzelek11@gmail.com',
            'password' => $password,
            'type' => 'player'
        ]);
        User::create([
            'first_name' => 'Aleksander',
            'last_name' => 'Stopiński',
            'email' => 'stopina32@gmail.com',
            'password' => $password,
            'type' => 'player'
        ]);
    }
}
