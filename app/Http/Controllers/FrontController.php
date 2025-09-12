<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\Testimonial;
use App\Services\PaymentService;
use App\Services\PricingService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Event\Code\Test;

class FrontController extends Controller
{
    //

    protected $transactionService;
    protected $paymentService;
    protected $pricingService;

    public function __construct(
        PaymentService $paymentService,
        TransactionService $transactionService,
        PricingService $pricingService
    ) {
        $this->paymentService = $paymentService;
        $this->transactionService = $transactionService;
        $this->pricingService = $pricingService;
    }

    public function index()
    {
        return view('front.index');
    }

    public function pricing()
    {
        $pricing_packages = $this->pricingService->getAllPackages();
        $user = Auth::user(); // Get the logged-in user
        $testimonials = Testimonial::all();
        return view('front.pricing', compact('pricing_packages', 'user', 'testimonials'));
    }

    public function features()
    {
        return view('front.features');
    }

    public function checkout(Pricing $pricing)
    {
        $checkoutData = $this->transactionService->prepareCheckout($pricing);

        if ($checkoutData['alreadySubscribed']) {
            return redirect()->route('front.pricing')->with('error', 'You are already subscribed to this plan.');
        }

        return view('front.checkout', $checkoutData);
    }

    public function paymentStoreMidtrans()
    {
        try {
            // Retrieve the pricing ID from the session
            $pricingId = session()->get('pricing_id');

            if (!$pricingId) {
                return response()->json(['error' => 'No pricing data found in the session.'], 400);
            }

            // Call the PaymentService to generate the Snap token
            $snapToken = $this->paymentService->createPayment($pricingId);

            if (!$snapToken) {
                return response()->json(['error' => 'Failed to create Midtrans transaction.'], 500);
            }

            // Return the Snap token to the frontend
            return response()->json(['snap_token' => $snapToken], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during transaction creation
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()], 500);
        }
    }

    public function paymentMidtransNotification(Request $request)
    {
        try {
            // Process the Midtrans notification through the service
            $transactionStatus = $this->paymentService->handlePaymentNotification();

            if (!$transactionStatus) {
                return response()->json(['error' => 'Invalid notification data.'], 400);
            }

            // Respond with the status of the transaction

            // transaction has been created in database
            return response()->json(['status' => $transactionStatus]);
        } catch (\Exception $e) {
            Log::error('Failed to handle Midtrans notification:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to process notification.'], 500);
        }
    }

    public function checkout_success()
    {
        $pricing = $this->transactionService->getRecentPricing();

        if (!$pricing) {
            return redirect()->route('front.pricing')->with('error', 'No recent subscription found.');
        }

        return view('front.checkout_success', compact('pricing'));
    }

    public function checkout_failed(Request $request)
    {
        // Opsional: tetap coba ambil paket terakhir agar halaman failed bisa
        // menampilkan nama paket/durasi yang sedang dicoba dibayar
        $pricing = $this->transactionService->getRecentPricing();

        // Ambil alasan yang dikirim via query (?reason=...)
        $failure_reason = $request->query('reason');

        // NOTE: Jangan redirect walau $pricing kosong, biarkan halaman failed tampil
        // dengan informasi yang ada saja, supaya user tetap paham statusnya.
        return view('front.checkout_failed', compact('pricing', 'failure_reason'));
    }
    
    /**
     * Show the user settings page.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        $user = Auth::user();
        return view('courses.setting-user', compact('user'));
    }
    
    /**
     * Update user profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        
        $user = Auth::user();
        $user->name = $request->name;
        $user->occupation = $request->occupation;
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            
            // Store new photo
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }
        
        $user->save();
        
        return redirect()->route('dashboard.settings')->with('status', 'profile-updated');
    }
    
    /**
     * Update user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('dashboard.settings')->with('status', 'password-updated');
    }
    
    /**
     * Reset user password to default.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword()
    {
        $user = Auth::user();
        $user->password = Hash::make('123123123');
        $user->save();
        
        return redirect()->route('dashboard.settings')->with('status', 'password-reset');
    }
}
