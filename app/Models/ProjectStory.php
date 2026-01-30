<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStory extends Model
{
    protected $table = 'project_stories';

    protected $primaryKey = 'story_id';

    protected $fillable = [
        'project_id',
        'challenge',
        'solution',
        'result'
    ];

    public $timestamps = true;

    // Relasi: story milik satu project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}
