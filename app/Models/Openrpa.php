<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Openrpa extends Model
{
    protected $table = 'openrpa';
    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
}
