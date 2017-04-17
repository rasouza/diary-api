<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
    protected $fillable = [
        'name',  
        'login', 
        'bio', 
        'avatar', 
        'token'
    ];
}
