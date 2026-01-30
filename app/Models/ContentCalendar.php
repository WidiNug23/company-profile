<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentCalendar extends Model
{
    protected $primaryKey = 'calendar_id';

    protected $fillable = [
        'title','note','scheduled_date','created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
