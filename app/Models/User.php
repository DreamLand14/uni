<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function enrollments(){
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function ongoingEnrollments(){
        return $this->hasMany(Enrollment::class, 'course_id')->where('status', 'ongoing');
    }
}
