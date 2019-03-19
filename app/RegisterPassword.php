<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterPassword extends Model
{
    protected $fillable = ['password', 'active'];
}
