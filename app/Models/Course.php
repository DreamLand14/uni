<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function sessions(){
        return $this->hasMany(CourseSession::class, 'course_id');
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function ongoingEnrollments(){
        return $this->hasMany(Enrollment::class, 'course_id')->where('status', 'ongoing');
    }

    public function requirements(){
        return $this->hasMany(Requirement::class, 'course_id');
    }
}
