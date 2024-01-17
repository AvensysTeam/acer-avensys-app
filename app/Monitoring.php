<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = "monitoring";
    protected $fillable = [
        'monitor_new_user',
        'monitor_logged_in_user',
        'new_user_monitoring_level',
        'logged_in_monitoring_level',
    ];
}
