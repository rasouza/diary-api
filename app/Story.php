<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title', 'date', 'description', 'project', 'link'];
    protected $dates = ['date'];
}
