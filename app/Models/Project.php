<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'project_name',
        'location',
        'year',
        'thumbnail'
    ];

    public $timestamps = true;

    // Relasi: 1 project punya banyak stories
    public function stories()
    {
        return $this->hasMany(ProjectStory::class, 'project_id', 'project_id');
    }
}
