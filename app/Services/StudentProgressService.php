<?php

namespace App\Services;

use App\Models\Course;
use App\Models\SectionContent;
use App\Models\User;
use App\Repositories\StudentProgressRepositoryInterface;
use Illuminate\Support\Collection;

class StudentProgressService
{
    protected $studentProgressRepository;

    public function __construct(StudentProgressRepositoryInterface $studentProgressRepository)
    {
        $this->studentProgressRepository = $studentProgressRepository;
    }

    /**
     * Mark a section content as completed by the current user
     */
    public function markAsCompleted(Course $course, SectionContent $sectionContent): bool
    {
        $user = auth()->user();
        return $this->studentProgressRepository->markAsCompleted($user, $course, $sectionContent);
    }

    /**
     * Get all completed section contents for the current user in a course
     */
    public function getCompletedContents(Course $course): Collection
    {
        $user = auth()->user();
        return $this->studentProgressRepository->getCompletedContents($user, $course);
    }

    /**
     * Get progress percentage for the current user in a course
     */
    public function getProgressPercentage(Course $course): float
    {
        $user = auth()->user();
        return $this->studentProgressRepository->getProgressPercentage($user, $course);
    }

    /**
     * Get all courses with progress for the current user
     */
    public function getCoursesWithProgress(): Collection
    {
        $user = auth()->user();
        return $this->studentProgressRepository->getCoursesWithProgress($user);
    }

    /**
     * Get portfolio data for the current user
     */
    public function getPortfolioData(): array
    {
        $user = auth()->user();
        $coursesWithProgress = $this->studentProgressRepository->getCoursesWithProgress($user);

        // Calculate overall statistics
        $totalCourses = $coursesWithProgress->count();
        $completedCourses = $coursesWithProgress->where('progress_percentage', 100)->count();
        $totalContents = $coursesWithProgress->sum('total_contents_count');
        $completedContents = $coursesWithProgress->sum('completed_contents_count');
        $overallProgress = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;

        // Calculate category statistics
        $categoryStats = [];
        $totalCategoriesCount = 0;
        $completedCategoriesCount = 0;
        $startedCoursesCount = 0;

        foreach ($coursesWithProgress as $course) {
            $categoryName = $course->category->name ?? 'Uncategorized';

            // Count started courses for Experience calculation
            if ($course->completed_contents_count > 0) {
                $startedCoursesCount++;
            }

            if (!isset($categoryStats[$categoryName])) {
                $categoryStats[$categoryName] = [
                    'total_courses' => 0,
                    'completed_courses' => 0,
                    'total_contents' => 0,
                    'completed_contents' => 0,
                    'progress' => 0,
                ];
                $totalCategoriesCount++;
            }

            $categoryStats[$categoryName]['total_courses']++;
            if ($course->progress_percentage == 100) {
                $categoryStats[$categoryName]['completed_courses']++;
            }
            $categoryStats[$categoryName]['total_contents'] += $course->total_contents_count;
            $categoryStats[$categoryName]['completed_contents'] += $course->completed_contents_count;

            // Calculate category progress percentage
            if ($categoryStats[$categoryName]['total_contents'] > 0) {
                $categoryStats[$categoryName]['progress'] =
                    ($categoryStats[$categoryName]['completed_contents'] / $categoryStats[$categoryName]['total_contents']) * 100;

                // Check if category is completed (all courses in category completed)
                if ($categoryStats[$categoryName]['completed_courses'] == $categoryStats[$categoryName]['total_courses'] &&
                    $categoryStats[$categoryName]['total_courses'] > 0) {
                    $completedCategoriesCount++;
                }
            }
        }

        // Calculate Experience (based on started courses across all categories)
        $experience = $totalCourses > 0 ? min(100, ($startedCoursesCount / $totalCourses) * 100) : 0;

        // Calculate HP (based on completed courses)
        $hp = $totalCourses > 0 ? min(100, ($completedCourses / $totalCourses) * 100) : 0;

        // Calculate MP (based on completed categories)
        $mp = $totalCategoriesCount > 0 ? min(100, ($completedCategoriesCount / $totalCategoriesCount) * 100) : 0;

        return [
            'user' => $user,
            'stats' => [
                'total_courses' => $totalCourses,
                'completed_courses' => $completedCourses,
                'total_contents' => $totalContents,
                'completed_contents' => $completedContents,
                'overall_progress' => $overallProgress,
                'categories' => $categoryStats,
                'experience' => $experience,
                'hp' => $hp,
                'mp' => $mp,
                'total_categories' => $totalCategoriesCount,
                'completed_categories' => $completedCategoriesCount,
                'started_courses' => $startedCoursesCount,
                'courses' => $coursesWithProgress, // Add courses to stats array for access in view
            ],
        ];
    }
}
