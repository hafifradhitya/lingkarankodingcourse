<?php
// app/Http/Middleware/CourseAccess.php
namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Ambil model Course dari route model binding "course"
        /** @var \App\Models\Course|null $course */
        $course = $request->route('course');

        // Jika route tidak membawa Course (edge case), fallback ke rules lama
        if (!$course instanceof Course) {
            if (!$user || !$user->hasActiveSubscription()) {
                return redirect()->route('front.pricing')->with('error', 'You need an active subscription to proceed');
            }
            return $next($request);
        }

        // Akses diizinkan jika course gratis atau user punya subscription
        if ($course->is_free || ($user && $user->hasActiveSubscription())) {
            return $next($request);
        }

        // Premium tapi user tidak berlangganan
        return redirect()->route('front.pricing')->with('error', 'Kelas premium. Silakan berlangganan untuk melanjutkan.');
    }
}
