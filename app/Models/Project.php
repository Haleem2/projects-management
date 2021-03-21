<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'user_id'
    ];

    protected $dates=[
        'start_date','end_date'
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function project()
    {
        return $this->belongsTo(User::class);
    }
}
