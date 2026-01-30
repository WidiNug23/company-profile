<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certifications';

    protected $primaryKey = 'certification_id';

    protected $fillable = [
        'certification_name',
        'description',
        'file'
    ];

    public $timestamps = true;
}
