<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profile';

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'title',
        'description',
        'created_at',
        'update_at'
    ];

    public $timestamps = true;
}
