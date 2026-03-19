<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\UserCode;
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
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        Mail::to(auth('web')->user()->email)->send(new WelcomeEmail(auth('web')->user()->firstname));
        return redirect()->route('user.profile');
    }

    public function verify2(Request $request)
    {
        $this->validate($request, [
            'code' => ['required', 'numeric']
        ],[
            'code.required' => 'Verification code is required',
            'code.numeric' => 'Verification code must be numeric',
        ]);
        $user_code = UserCode::where('user_id', auth('web')->id())->first();
        if (Hash::check($request->code, $user_code->key)) {
            $expire_at = $user_code->updated_at->copy()->addMinutes(30);
            if (Carbon::now()->gt($expire_at)) {
                return back()->withErrors(['err_msg' => 'Verification code has expired.']);
            }
            if (! auth('web')->user()->hasVerifiedEmail()) {
                auth('web')->user()->markEmailAsVerified();
                event(new Verified(auth('web')->user()));
                Mail::to(auth('web')->user()->email)->send(new WelcomeEmail(auth('web')->user()->firstname));
            }
            $user_code->update(['key' => Hash::make(Str::random())]);
            return redirect()->route('user.profile');
        }
        return back()->withErrors(['err_msg' => 'Invalid verification code, pls try again.']);
    }
}
