<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRobot extends Model
{
    use HasFactory;
    protected $table = 'user_robots';

    protected $fillable = [
        'user_id',
        'robot_id',
        'status',
    ];
}
