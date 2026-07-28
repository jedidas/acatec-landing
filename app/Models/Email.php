<?php

namespace App\Models;

use App\Events\EmailCreated;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'email',
        'phone',
        'message',
        'added_on',
        'is_active',
    ];

    protected $dispatchesEvents = [
        'created' => EmailCreated::class,
    ];
}
