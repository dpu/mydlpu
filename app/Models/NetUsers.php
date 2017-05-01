<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NetUsers extends Model
{
    use SoftDeletes;

    protected $table = 'net_users';
    protected $dates = ['deleted_at'];
}