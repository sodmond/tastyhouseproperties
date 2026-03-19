<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\SellerCode;
use App\Notifications\EmailVerify;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/seller/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:seller');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect($this->redirectPath())
                    : view('seller.auth.verify');
    }

    public function resend(Request $request)
    {
        #$request->user()->sendEmailVerificationNotification();
        auth('seller')->user()->notify(new EmailVerify);
        return back()->with('resent', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        Mail::to(auth('seller')->user()->email)->send(new WelcomeEmail(auth('seller')->user()->firstname));
        return redirect()->route('seller.profile');
    }

    public function verify2(Request $request)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric']
        ],[
            'code.required' => 'Verification code is required',
            'code.numeric' => 'Verification code must be numeric',
        ]);
        $seller_code = SellerCode::where('seller_id', auth('seller')->id())->first();
        if (Hash::check($request->code, $seller_code->key)) {
            $expire_at = $seller_code->updated_at->copy()->addMinutes(30);
            if (Carbon::now()->gt($expire_at)) {
                return back()->withErrors(['err_msg' => 'Verification code has expired.']);
            }
            if (! auth('seller')->user()->hasVerifiedEmail()) {
                auth('seller')->user()->markEmailAsVerified();
                event(new Verified(auth('seller')->user()));
                Mail::to(auth('seller')->user()->email)->send(new WelcomeEmail(auth('seller')->user()->firstname));
            }
            $seller_code->update(['key' => Hash::make(Str::random())]);
            return redirect()->route('seller.profile');
        }
        return back()->withErrors(['err_msg' => 'Invalid verification code, pls try again.']);
    }
}
