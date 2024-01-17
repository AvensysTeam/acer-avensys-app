<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Settings extends Model
{
    use SoftDeletes;

    public $table = 'settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user',
        'image',
        'comname',
        'comaddr',
        'comtel',
        'comfax',
        'conname',
        'contel',
        'conmobile',
        'conemail',
        'monitor_new_user',
        'monitor_logged_in_user',
        'new_user_monitoring_level',
        'logged_in_monitoring_level',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
