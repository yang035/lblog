<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = "message_model";
    protected $dates = ['published_at'];
    protected $fillable = [
        'title', 'content', 'status',
    ];
}
