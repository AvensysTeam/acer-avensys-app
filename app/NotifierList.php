<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifierList extends Model
{
    protected $table = "notifier_list";

    protected $fillable = ['email','name','phone','is_active'];
}
