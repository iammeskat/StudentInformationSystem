<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
        'status',
    ];
<<<<<<< HEAD
=======


    public function post_for(){
        return $this->hasOne('App\Models\PostFor');
    }
>>>>>>> admin_panel
}
