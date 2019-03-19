<?php

use Illuminate\Database\Seeder;
use App\Character;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Character::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        Character::create([
            'race' => 'human',
            'class' => 'rogue',
            'nick_name' => 'Misiaq',
            'user_id' => 2,
        ]);
        Character::create([
            'race' => 'undead',
            'class' => 'warlock',
            'nick_name' => 'Zuzax',
            'user_id' => 2
        ]);
        Character::create([
            'race' => 'human',
            'class' => 'paladin',
            'nick_name' => 'Faker',
            'user_id' => 3
        ]);
    }
}
