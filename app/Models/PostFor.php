<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostFor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'all',
        'student',
        'semester',
        'teacher',
        'cr',
        'batch',
        'course_id',
        
    ];
}
