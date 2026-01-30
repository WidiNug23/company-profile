<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $table = 'visitor_logs';

    protected $fillable = [
        'ip_address',
        'url',
        'user_agent',
    ];

    public $timestamps = true;
}
