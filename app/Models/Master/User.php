<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'client_id',
        'role',
        'name',
        'email',
        'phone_number',
        'password',
        'start_active',
        'end_active',
        'status',
    ];
}
