<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EduUsers extends Model
{
    use SoftDeletes;

    protected $table = 'edu_users';
    protected $dates = ['deleted_at'];
}