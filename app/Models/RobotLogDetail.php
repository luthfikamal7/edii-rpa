<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotLogDetail extends Model
{
    use HasFactory;
    protected $table = 'robot_log_details';

    protected $fillable = [
        'robot_log_id',
        'start_date',
        'end_date',
        'title',
        'nomor',
        'status',
        'status_error',
    ];
}
