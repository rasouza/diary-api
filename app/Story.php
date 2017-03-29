<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Story extends Model
{
    protected $fillable = ['title', 'date', 'description', 'project', 'link'];
    protected $dates = ['date'];

    public function setDateAttribute($value) { $this->attributes['date'] = Carbon::parse($value); }
}
