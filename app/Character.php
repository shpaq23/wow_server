<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['nick_name', 'race', 'class', 'level', 'user_id', 'active'];
}
