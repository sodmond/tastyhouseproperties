<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Mail\ApprovalStatus;
use App\Mail\SendPasswordChange;
use App\Models\Seller;
use App\Models\City;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    public function index()
    {
        #$seller_parent = sellerParent::where('seller_id', auth('seller')->id())->first();
        /*$age = Carbon::now()->diff(auth('seller')->user()->dob);
        if (!$seller_parent) {
            $seller_parent = sellerParent::create(['seller_id' => auth('seller')->id()]);
        }*/
        $states = State::all();
        return view('seller.profile', compact('states'));
    }

    public function edit()
    {
        $states = State::all();
        $cities = City::where('state_id', auth('seller')->user()->state)->get();
        return view('seller.profile_edit', compact('states', 'cities'));
    }

    public function update(ProfileRequest $request)
    {
        auth('seller')->user()->update($request->all());
        $successMsg = 'Profile successfully updated.';
        if(auth('seller')->user()->image == '') {
            $successMsg .= ' The business logo is mandatory to proceed to the next section.';
            return back()->with('success', $successMsg);
        }
        return redirect()->route('seller.profile')->with('success', $successMsg);
    }

    public function updateImage(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:1024', Rule::dimensions()->minWidth(300)->minHeight(300)]
        ],[
            'image.dimensions' => 'The image is too small, you need to upload a bigger image',
        ]); #dd($request->all());
        if (Storage::exists('public/'.auth('seller')->user()->image)) {
            Storage::delete('public/'.auth('seller')->user()->image);
        }
        $imgName = time() . '.' . $request->file('image')->extension();
        #$request->file('image')->storeAs("seller/profile_pix", $imgName, 'public');
        $thumbnail = ImageManager::gd()->read($request->file('image')->path());
        $thumbnail->cover(300, 300, 'center')->save(storage_path('/app/public/seller/profile_pix/'. $imgName));
        Seller::where('id', auth('seller')->id())->update(['image' => $imgName]);
        return back()->with('success', 'Profile picture successfully updated.');
    }

    public function password()
    {
        return view('seller.change_password');
    }

    public function passwordUpdate(PasswordRequest $request)
    {
        auth('seller')->user()->update(['password' => Hash::make($request->get('password'))]);
        Mail::to(auth('seller')->user()->email)->send(new SendPasswordChange(auth('seller')->user()->firstname));
        return back()->with('success', 'Password successfully updated.');
    }

    public function verifyNin(Request $request)
    {
        $this->validate($request, [
            'nin' => ['required', 'numeric']
        ]);
        $api_data = DB::table('api_data')->where('name', 'QoreID')->first();
        $bearerToken = $api_data->access_token;
        $verNIN = Http::withToken($bearerToken)
            ->post(config('qoreid.baseUrl')."/v1/ng/identities/nin/$request->nin", [
            "firstname"        => auth('seller')->user()->firstname, 
        	"lastname"         => auth('seller')->user()->lastname,
            "dob"              => auth('seller')->user()->dob,
            "gender"           => auth('seller')->user()->gender,
        ]);
        if ($verNIN->successful()) {
            $data = $verNIN->json();
            if($data['summary']['nin_check']['status'] == 'EXACT_MATCH' && $data['summary']['nin_check']['fieldMatches']['gender'] == true) {
                $ninData = $data['nin'];
                if(strtotime($ninData['birthdate']) != strtotime(auth('seller')->user()->dob)) {
                    return back()->withErrors(['err_msg' => 'The NIN provided has a partial match, please update your profile and try again']);
                }
                auth('seller')->user()->update([
                    'nin' => Hash::make($ninData['nin']),
                    'kyc_status' => true,
                    'nin_photo' => $ninData['photo']
                ]);
                Mail::to(auth('seller')->user()->email)->send(new ApprovalStatus(1));
                return back()->with('success', 'Your account has now been verified.');
            }
            if($data['summary']['nin_check']['status'] == 'PARTIAL_MATCH') {
                return back()->withErrors(['err_msg' => 'The NIN provided has a partial match, please update your profile and try again']);
            }
            return back()->withErrors(['err_msg' => 'The NIN provided do not match your profile, please update your profile and try again']);
        }
        Log::info($verNIN->json());
        return back()->withErrors(['err_msg' => 'Problem ecountered with verification, please try again.']);
    }
}
