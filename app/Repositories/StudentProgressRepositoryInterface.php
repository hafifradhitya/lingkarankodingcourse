<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\SectionContent;
use App\Models\User;
use Illuminate\Support\Collection;

interface StudentProgressRepositoryInterface
{
    /**
     * Mark a section content as completed by a user
     */
    public function markAsCompleted(User $user, Course $course, SectionContent $sectionContent): bool;
    
    /**
     * Get all completed section contents for a user in a course
     */
    public function getCompletedContents(User $user, Course $course): Collection;
    
    /**
     * Get progress percentage for a user in a course
     */
    public function getProgressPercentage(User $user, Course $course): float;
    
    /**
     * Get all courses with progress for a user
     */
    public function getCoursesWithProgress(User $user): Collection;
}