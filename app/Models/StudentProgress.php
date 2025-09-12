<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProgress extends Model
{
    protected $table = 'student_progress';
    
    protected $fillable = [
        'user_id',
        'course_id',
        'section_content_id',
        'completed_at',
    ];
    
    protected $casts = [
        'completed_at' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    
    public function sectionContent(): BelongsTo
    {
        return $this->belongsTo(SectionContent::class);
    }
}