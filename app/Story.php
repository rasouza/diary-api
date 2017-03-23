<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    private $_fillable = ['title', 'date', 'description', 'project', 'link'];
}
