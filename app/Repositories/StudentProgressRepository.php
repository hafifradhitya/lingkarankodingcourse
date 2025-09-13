<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\SectionContent;
use App\Models\StudentProgress;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StudentProgressRepository implements StudentProgressRepositoryInterface
{
    /**
     * Mark a section content as completed by a user
     */
    public function markAsCompleted(User $user, Course $course, SectionContent $sectionContent): bool
    {
        $progress = StudentProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'section_content_id' => $sectionContent->id,
            ],
            [
                'course_id' => $course->id,
                'completed_at' => Carbon::now(),
            ]
        );

        return $progress->wasRecentlyCreated || $progress->wasChanged();
    }

    /**
     * Get all completed section contents for a user in a course
     */
    public function getCompletedContents(User $user, Course $course): Collection
    {
        return StudentProgress::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->with('sectionContent')
            ->get()
            ->pluck('sectionContent');
    }

    /**
     * Get progress percentage for a user in a course
     */
    public function getProgressPercentage(User $user, Course $course): float
    {
        // Get total number of section contents in the course
        $course->load('courseSections.sectionContents');
        $totalContents = $course->courseSections->flatMap->sectionContents->count();

        if ($totalContents === 0) {
            return 0;
        }

        // Get number of completed contents
        $completedContents = StudentProgress::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->count();

        return ($completedContents / $totalContents) * 100;
    }

    /**
     * Get all courses with progress for a user
     */
    public function getCoursesWithProgress(User $user): Collection
    {
        // Get all courses the user is enrolled in with eager loading of category
        $courses = Course::whereHas('courseStudents', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['courseSections.sectionContents', 'category'])->get();

        // Calculate progress for each course
        return $courses->map(function ($course) use ($user) {
            $course->progress_percentage = $this->getProgressPercentage($user, $course);
            $course->completed_contents_count = StudentProgress::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->count();
            $course->total_contents_count = $course->courseSections->flatMap->sectionContents->count();
            $course->last_activity = StudentProgress::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->latest('completed_at')
                ->first()?->completed_at;

            return $course;
        });
    }
}
