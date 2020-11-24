<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsEnroll extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'session',
        'semester',
        'status',
    ];
}
