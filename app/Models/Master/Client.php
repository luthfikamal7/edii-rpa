<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone_number',
        'pic',
        'phone_number_pic',
        'website',
        'status',
    ];
}
