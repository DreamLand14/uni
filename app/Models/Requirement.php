<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function required(){
        return $this->belongsTo(Course::class, 'required_id');
    }
}
