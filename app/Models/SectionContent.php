<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionContent extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'course_section_id',
        'content',
        'path_video',
    ];

    public function courseSection(): BelongsTo
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id');
    }

    // ---- [ADD] accessor: $sectionContent->youtube_id ----
    public function getYoutubeIdAttribute(): ?string
    {
        $val = $this->path_video;
        if (!$val) return null;

        // Jika sudah 11-char ID, langsung return
        if (preg_match('~^[A-Za-z0-9_-]{11}$~', $val)) {
            return $val;
        }

        // Ekstrak dari berbagai format URL (watch?v= | youtu.be/ | embed/)
        if (preg_match('~(?:v=|youtu\.be/|embed/)([A-Za-z0-9_-]{11})~', $val, $m)) {
            return $m[1];
        }

        // fallback: kembalikan string as-is (biar ketahuan saat salah)
        return $val;
    }
}
