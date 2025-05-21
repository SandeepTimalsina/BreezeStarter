<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subgoal extends Model
{
    protected $fillable = [
        'title', 'description', 'goal_id', 'created_by', 'deadline', 'extended_time', 'required_files'
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

