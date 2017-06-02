<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 */
class Message extends Model
{
    protected $table = 'messages';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'to',
        'type',
        'content'
    ];

    protected $guarded = [];

        
}