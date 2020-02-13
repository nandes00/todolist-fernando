<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    Use SoftDeletes;

    protected $fillable = ['title', 'description', 'priority', 'author', 'date', 'status'];
    protected $dates = ['deleted_at'];
}
