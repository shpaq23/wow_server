<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->nullable(false)->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('nick_name', 25)->nullable(false)->unique();
            $table->enum('race', ['human','dwarf', 'gnome', 'night elf', 'orc', 'troll', 'tauren', 'undead'])->nullable(false);
            $table->enum('class', ['warrior', 'mage', 'rogue', 'hunter', 'warlock', 'druid', 'shaman', 'paladin', 'priest'])->nullable(false);
            $table->unsignedTinyInteger('level')->nullable(false)->default(1);
            $table->boolean('active')->nullable(false)->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
