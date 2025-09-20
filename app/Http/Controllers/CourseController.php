<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentProgress;
use App\Services\CourseService;
use App\Services\StudentProgressService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CourseController extends Controller
{
    //
    protected $courseService;

    public function __construct(
        CourseService $courseService,
    ) {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $coursesByCategory = $this->courseService->getCoursesGroupedByCategory();
        $popularCourses    = $this->courseService->getPopularCourses(6);

        return view('courses.index', compact('coursesByCategory', 'popularCourses'));
    }


    // public function index()
    // {
    //     $coursesByCategory = Course::with('category')
    //         ->latest()
    //         ->get()
    //         ->groupBy(function ($course) {
    //             return $course->category->name ?? 'Uncategorized';
    //             // Programming, UI UX, Marketing, Uncategorized
    //         });

    //     return view('courses.index', compact('coursesByCategory'));
    // }

    public function details(Course $course)
    {
        // eager loading
        $course->load([
            'category',
            'benefits',
            'courseSections.sectionContents',
            'courseMentors.mentor',
            'testimonials.course',
            'tools'
        ]);
        return view('courses.details', compact('course'));
    }

    // public function storeTestimonial(Request $request, Course $course)
    // {
    //     if (!auth()->check() || !auth()->user()->hasActiveSubscription()) {
    //         return back()->with('error', 'Kamu harus memiliki subscription aktif untuk memberikan testimonial.');
    //     }

    //     // Cek apakah student ini (berdasarkan nama) sudah review course ini
    //     $already = $course->testimonials()
    //         ->where('name', auth()->user()->name)
    //         ->exists();

    //     if ($already) {
    //         return back()->with('error', 'Anda sudah membuat ulasan');
    //     }

    //     $validated = $request->validate([
    //         // unique berdasarkan (course_id, name) TANPA ubah DB:
    //         'name'       => [
    //             'required','string','max:255',
    //             Rule::unique('testimonials', 'name')->where(fn ($q) =>
    //                 $q->where('course_id', $course->id)
    //             ),
    //         ],
    //         'occupation' => ['nullable','string','max:255'],
    //         'review'     => ['required','string'],
    //         'photo'      => ['nullable','image','max:2048'],
    //     ], [
    //         'name.unique' => 'Anda sudah membuat ulasan',
    //     ]);

    //     $path = null;
    //     if ($request->hasFile('photo')) {
    //         $path = $request->file('photo')->store('testimonials', 'public');
    //     }

    //     $course->testimonials()->create([
    //         'name'       => $validated['name'],
    //         'occupation' => $validated['occupation'] ?? null,
    //         'review'     => $validated['review'],
    //         'photo'      => $path,
    //     ]);

    //     return back()->with('success', 'Terima kasih! Testimonial kamu sudah terkirim.');
    // }

    public function storeTestimonial(Request $request, Course $course)
    {
        $user = auth()->user();

        if (!$user || !$user->hasActiveSubscription()) {
            return back()->with('error', 'Kamu harus memiliki subscription aktif untuk memberikan testimonial.');
        }

        // Cegah duplikat: satu user (berdasarkan nama) hanya sekali per course
        $already = $course->testimonials()
            ->where('name', $user->name)
            ->exists();

        if ($already) {
            return back()->with('error', 'Anda sudah membuat ulasan');
        }

        // Validasi hanya field review
        $validated = $request->validate([
            'review' => ['required', 'string', 'max:2000'],
        ]);

        // Simpan memakai data dari user login
        $course->testimonials()->create([
            'name'       => $user->name,
            'occupation' => $user->occupation ?? null,
            'review'     => $validated['review'],
            // jika ingin ikutkan foto profil user, isi di sini:
            'photo'   => $user->photo ?? null,
        ]);

        return back()->with('success', 'Terima kasih! Testimonial kamu sudah terkirim.');
    }

    // app/Http/Controllers/CourseController.php
    public function join(Course $course)
    {
        $studentName = $this->courseService->enrollUser($course);
        $first = $this->courseService->getFirstSectionAndContent($course);

        // Kelas gratis: kalau sudah ada konten → langsung mulai belajar
        if ($course->is_free && $first['hasContent']) {
            return redirect()->route('dashboard.course.learning', [
                'course'         => $course->slug,
                'courseSection'  => $first['firstSectionId'],
                'sectionContent' => $first['firstContentId'],
            ]);
        }

        // Premium (setelah bayar) ATAU Gratis tapi belum ada konten → tampil success
        return view('courses.success_joined', array_merge(
            compact('course', 'studentName'),
            $first
        ));
    }

    public function portfolio()
    {
        $portfolioData = app(\App\Services\StudentProgressService::class)->getPortfolioData();
        return view('courses.portfolio', $portfolioData);
    }

    // public function join(Course $course)
    // {
    //     $studentName = $this->courseService->enrollUser($course);
    //     $firstSectionAndContent = $this->courseService->getFirstSectionAndContent($course);

    //     return view('courses.success_joined', array_merge(
    //         compact('course', 'studentName'),
    //         $firstSectionAndContent
    //     ));
    // }

    // public function join(Course $course)
    // {
    //     $studentName = $this->courseService->enrollUser($course);
    //     $first = $this->courseService->getFirstSectionAndContent($course);

    //     // kalau konten tersedia, langsung masuk ke learning
    //     if (!empty($first['firstSectionId']) && !empty($first['firstContentId'])) {
    //         return redirect()->route('dashboard.course.learning', [
    //             'course'         => $course->slug,
    //             'courseSection'  => $first['firstSectionId'],
    //             'sectionContent' => $first['firstContentId'],
    //         ]);
    //     }

    //     // kalau belum ada konten, tampilkan halaman sukses join seperti biasa
    //     return view('courses.success_joined', array_merge(
    //         compact('course', 'studentName'),
    //         $first
    //     ));
    // }

    public function learning(Course $course, $contentSectionId, $sectionContentId)
    {
        $learningData = $this->courseService->getLearningData($course, $contentSectionId, $sectionContentId);

        return view('courses.learning', $learningData);
    }

    public function learning_finished(Course $course)
    {
        $user = auth()->user();

        // Periksa apakah semua konten telah diselesaikan
        $studentProgressService = app(StudentProgressService::class);
        $completedContents = $studentProgressService->getCompletedContents($course);

        // Hitung total konten
        $allContents = collect();
        foreach ($course->courseSections as $section) {
            $allContents = $allContents->merge($section->sectionContents);
        }

        $totalContents = $allContents->count();
        $completedCount = $completedContents->count();
        $isAllCompleted = $totalContents > 0 && $completedCount >= $totalContents;

        // Jika semua konten telah diselesaikan, atur completed_at
        if ($isAllCompleted) {
            // Cari progress terakhir untuk menandai course sebagai selesai
            $progress = StudentProgress::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->whereNull('completed_at')
                ->update(['completed_at' => Carbon::now()]);
        }

        return view('courses.learning_finished', compact('course'));
    }

    /**
     * Menampilkan sertifikat untuk course yang telah diselesaikan
     */
    public function showCertificate(Course $course)
    {
        $user = auth()->user();

        // Cek apakah user telah menyelesaikan course
        $progress = StudentProgress::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereNotNull('completed_at')
            ->first();

        if (!$progress) {
            return redirect()->route('dashboard.course.details', $course->slug)
                ->with('error', 'Anda belum menyelesaikan course ini.');
        }

        $completedAt = $progress->completed_at;

        // Ambil data mentor course
        $courseMentor = $course->courseMentors()->with('mentor')->first();
        $mentorName = $courseMentor ? $courseMentor->mentor->name : 'Lingkaran Koding';
        $mentorOccupation = $courseMentor ? $courseMentor->mentor->occupation : 'Lingkaran Koding';

        // Generate PDF untuk ditampilkan di browser (landscape)
        $pdf = PDF::loadView('courses.certificate', compact('course', 'user', 'completedAt', 'mentorOccupation', 'mentorName'))
            ->setPaper('a4', 'landscape');
        return $pdf->stream('certificate.pdf');
    }

    /**
     * Mengunduh sertifikat untuk course yang telah diselesaikan
     */
    public function downloadCertificate(Course $course)
    {
        $user = auth()->user();

        // Cek apakah user telah menyelesaikan course
        $progress = StudentProgress::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereNotNull('completed_at')
            ->first();

        if (!$progress) {
            return redirect()->route('dashboard.course.details', $course->slug)
                ->with('error', 'Anda belum menyelesaikan course ini.');
        }

        $completedAt = $progress->completed_at;

        // Ambil data mentor course
        $courseMentor = $course->courseMentors()->with('mentor')->first();
        $mentorName = $courseMentor ? $courseMentor->mentor->name : 'Lingkaran Koding';

        // Generate PDF untuk diunduh (landscape)
        $pdf = PDF::loadView('courses.certificate', compact('course', 'user', 'completedAt', 'mentorName'))
            ->setPaper('a4', 'landscape');
        return $pdf->download($course->slug . '-certificate.pdf');
    }

    // public function search_courses(Request $request)
    // {
    //     $request->validate([
    //         'search' => 'required|string',
    //     ]);
    //     $keyword = $request->search;
    //     $courses = Course::where('name', 'like', "%{$keyword}%")
    //         ->orWhere('about', 'like', "%{$keyword}%")
    //         ->get();

    //     return view('courses.search', compact('courses', 'keyword'));
    // }

    public function search_courses(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $keyword = $request->search;

        // Delegate the search logic to the service
        $courses = $this->courseService->searchCourses($keyword);

        return view('courses.search', compact('courses', 'keyword'));
    }

    /**
     * Menampilkan halaman koleksi sertifikat yang dimiliki user
     */
    public function certificates()
    {
        $user = auth()->user();

        $completedCourses = \App\Models\StudentProgress::query()
            ->where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->with(['course.category'])
            ->get()
            ->pluck('course')
            ->filter()                // jaga-jaga kalau ada progress tanpa course terhubung
            ->unique('id')            // hilangkan duplikat course
            ->values();

        return view('courses.certificates-page', compact('completedCourses'));
    }
}
