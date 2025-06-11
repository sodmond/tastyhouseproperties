<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Mail\SendPasswordChange;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    public function index()
    {
        #$user_parent = userParent::where('user_id', auth('web')->id())->first();
        /*$age = Carbon::now()->diff(auth('web')->user()->dob);
        if (!$user_parent) {
            $user_parent = userParent::create(['user_id' => auth('web')->id()]);
        }*/
        $states = State::all();
        return view('user.profile', compact('states'));
    }

    public function edit()
    {
        $states = State::all();
        $cities = City::where('state_id', auth('web')->user()->state)->get();
        return view('user.profile_edit', compact('states', 'cities'));
    }

    public function update(ProfileRequest $request)
    {
        auth('web')->user()->update($request->all());
        return back()->with('success', 'Profile successfully updated.');
    }

    public function updateImage(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:1024', Rule::dimensions()->minWidth(300)->minHeight(300)]
        ]);
        if (Storage::exists('public/'.auth('web')->user()->image)) {
            Storage::delete('public/'.auth('web')->user()->image);
        }
        $imgName = time() . '.' . $request->file('image')->extension();
        #$request->file('image')->storeAs("user/profile_pix", $imgName, 'public');
        $thumbnail = ImageManager::gd()->read($request->file('image')->path());
        $thumbnail->cover(300, 300, 'center')->save(storage_path('/app/public/user/profile_pix/'. $imgName));
        User::where('id', auth('web')->id())->update(['image' => $imgName]);
        return back()->with('success', 'Profile picture successfully updated.');
    }

    public function password()
    {
        return view('user.change_password');
    }

    public function passwordUpdate(PasswordRequest $request)
    {
        auth('web')->user()->update(['password' => Hash::make($request->get('password'))]);
        Mail::to(auth('web')->user()->email)->send(new SendPasswordChange(auth('web')->user()->firstname));
        return back()->with('success', 'Password successfully updated.');
    }
}
