<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




class Goal extends Model
{



    protected $fillable = [
        'title', 'description', 'author', 'deadline', 'extended_time', 'required_files'
    ];

    // public function subgoals()
    // {
    //     return $this->hasMany(Subgoal::class);
    // }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

