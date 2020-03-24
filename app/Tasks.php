<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = array('id', 'user_id', 'task_name', 'task');
}
