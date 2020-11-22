<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'name',
        'department',
        'batch',
        'semester',
        'advisor_id',
        
    ];

    public function advisor(){
        return $this->belongsTo('App\Models\Advisor', 'advisor_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
