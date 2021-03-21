<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name', 'project_id', 'status'
    ];
    public function tasks()
    {
        return $this->belongsTo(Project::class);
    }
    
}
