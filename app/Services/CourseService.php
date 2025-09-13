<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function enrollUser(Course $course)
    {
        $user = Auth::user();

        // Double guard (defensive)
        if (!$user->hasAccessToCourse($course)) {
            abort(403, 'You are not allowed to enroll this course.');
        }

        if (!$course->courseStudents()->where('user_id', $user->id)->exists()) {
            $course->courseStudents()->create([
                'user_id' => $user->id,
                'is_active' => true
            ]);
        }

        return $user->name;
    }

    // public function getFirstSectionAndContent(Course $course)
    // {
    //     $firstSectionId = $course->courseSections()->orderBy('id')->value('id');
    //     $firstContentId = $firstSectionId
    //         ? $course->courseSections()->find($firstSectionId)->sectionContents()->orderBy('id')->value('id')
    //         : null;

    //     return [
    //         'firstSectionId' => $firstSectionId,
    //         'firstContentId' => $firstContentId,
    //     ];
    // }

    // // app/Services/CourseService.php
    // public function getFirstSectionAndContent(Course $course)
    // {
    //     // pastikan relasi sudah termuat
    //     $course->loadMissing('courseSections.sectionContents');

    //     // cari section pertama yang punya minimal 1 content
    //     $firstSectionWithContent = $course->courseSections
    //         ->sortBy('id')
    //         ->first(function ($s) {
    //             return $s->sectionContents && $s->sectionContents->count() > 0;
    //         });

    //     // fallback: kalau tidak ada section yang punya content, coba ambil section pertama saja
    //     $firstSection = $firstSectionWithContent ?: $course->courseSections->sortBy('id')->first();

    //     $firstSectionId = optional($firstSection)->id;
    //     $firstContentId = $firstSectionWithContent
    //         ? optional($firstSectionWithContent->sectionContents->sortBy('id')->first())->id
    //         : null;

    //     return [
    //         'firstSectionId' => $firstSectionId,
    //         'firstContentId' => $firstContentId,
    //         'hasContent'     => !is_null($firstSectionId) && !is_null($firstContentId),
    //     ];
    // }

    // app/Services/CourseService.php
    public function getFirstSectionAndContent(Course $course)
    {
        $course->loadMissing('courseSections.sectionContents');

        // Section pertama yang punya minimal 1 content
        $firstSectionWithContent = $course->courseSections
            ->sortBy('id')
            ->first(fn ($s) => $s->sectionContents && $s->sectionContents->count() > 0);

        $firstSectionId = optional($firstSectionWithContent)->id;
        $firstContentId = $firstSectionWithContent
            ? optional($firstSectionWithContent->sectionContents->sortBy('id')->first())->id
            : null;

        return [
            'firstSectionId' => $firstSectionId,
            'firstContentId' => $firstContentId,
            'hasContent'     => !is_null($firstSectionId) && !is_null($firstContentId),
        ];
    }

    public function getLearningData(Course $course, $contentSectionId, $sectionContentId)
    {
        $course->load(['courseSections.sectionContents']);

        $currentSection = $course->courseSections->find($contentSectionId);
        $currentContent = $currentSection ? $currentSection->sectionContents->find($sectionContentId) : null;

        // Determine next content
        $nextContent = null;

        if ($currentContent) {
            $nextContent = $currentSection->sectionContents
                ->where('id', '>', $currentContent->id)
                ->sortBy('id')
                ->first();
        }

        if (!$nextContent && $currentSection) {
            $nextSection = $course->courseSections
                ->where('id', '>', $currentSection->id)
                ->sortBy('id')
                ->first();

            if ($nextSection) {
                $nextContent = $nextSection->sectionContents->sortBy('id')->first();
            }
        }
        
        // Mark current content as completed
        if ($currentContent) {
            app(\App\Services\StudentProgressService::class)->markAsCompleted($course, $currentContent);
        }

        // Periksa apakah semua konten telah diselesaikan
        $allContents = collect();
        foreach ($course->courseSections as $section) {
            $allContents = $allContents->merge($section->sectionContents);
        }
        
        $completedContents = app(\App\Services\StudentProgressService::class)->getCompletedContents($course);
        $completedContentIds = $completedContents->pluck('id');
        
        // Hitung total konten dan jumlah konten yang telah diselesaikan
        $totalContents = $allContents->count();
        $completedCount = $completedContentIds->count();
        
        // Tombol Finish hanya muncul jika semua konten telah diselesaikan atau tidak ada konten berikutnya
        $isAllCompleted = $totalContents > 0 && $completedCount >= $totalContents;
        
        return [
            'course' => $course,
            'currentSection' => $currentSection,
            'currentContent' => $currentContent,
            'nextContent' => $nextContent,
            'isFinished' => !$nextContent && $isAllCompleted,
        ];

    }

    public function searchCourses(string $keyword)
    {
        return $this->courseRepository->searchByKeyword($keyword);
    }

    public function getPopularCourses(int $limit = 6)
    {
        return Course::with([
                'category:id,name',
                'courseSections.sectionContents',
            ])
            ->where('is_popular', true)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getCoursesGroupedByCategory()
    {
        $courses = $this->courseRepository->getAllWithCategory();

        return $courses->groupBy(function ($course) {
            return $course->category->name ?? 'Uncategorized';
        });
    }


    // MENAMPILKAN DATA KATEGORI YANG BELUM PUNYA KELAS
    // public function getCoursesGroupedByCategory()
    // {
    //     $categories = Category::all(); // Ambil semua kategori
    //     $courses = $this->courseRepository->getAllWithCategory(); // Ambil semua course

    //     // Kelompokkan course berdasarkan nama kategori
    //     $grouped = $courses->groupBy(function ($course) {
    //         return $course->category->name ?? 'Uncategorized';
    //     });

    //     // Pastikan semua kategori masuk ke array meskipun kosong
    //     $result = collect();

    //     foreach ($categories as $category) {
    //         $categoryName = $category->name;
    //         $result[$categoryName] = $grouped->get($categoryName, collect());
    //     }

    //     return $result;
    // }
}
