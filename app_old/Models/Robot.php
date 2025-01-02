<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    use HasFactory;
    protected $table = 'robots';

    protected $fillable = [
        'name',
        'description',
        'workflow_id',
        'status',
    ];
}
