<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'subgoal_id', 'assigned_to', 'status', 'deadline', 'extended_time', 'required_files'
    ];
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    public function subgoal()
    {
        return $this->belongsTo(Subgoal::class);
    }
    

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
