<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project_user extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
    ];
}
