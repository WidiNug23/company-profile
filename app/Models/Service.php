<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'description',
        'icon'
    ];
}
