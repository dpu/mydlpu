<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MinaUsers extends Model
{
    use SoftDeletes;

    protected $table = 'mina_users';
    protected $dates = ['deleted_at'];
}