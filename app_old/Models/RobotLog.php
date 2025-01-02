<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotLog extends Model
{
    use HasFactory;
    protected $table = 'robot_logs';

    protected $fillable = [
        'code',
        'robot_id',
        'user_id',
        'start_date',
        'end_date',
        'duration',
        'message',
        'status',
    ];
}
