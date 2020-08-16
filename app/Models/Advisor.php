<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id',
        'batch',
        'status',
    ];


    public function teacher(){
    	return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
