<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advert;
use App\Models\BasicSetting;
use App\Models\City;
use App\Models\Package;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $adminRoles = DB::table('admin_roles')->get();
        $admins = Admin::all();
        return view('admin.settings.index', compact('adminRoles', 'admins'));
    }

    public function viewAdmin($id)
    {
        $adminRoles = DB::table('admin_roles')->get();
        if ($id == 'new') {
            return view('admin.settings.admin_details', compact('adminRoles'));
        }
        $admin = Admin::find($id);
        return view('admin.settings.admin_details', compact('admin', 'adminRoles'));
    }

    public function newAdmin(Request $request)
    {
        if (auth('admin')->user()->role != 1) {
            return redirect()->route('admin.settings.home');
        }
        $this->validate($request, [
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:admins'],
            'role' => ['required', 'integer', 'exists:admin_roles,id'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
        if (auth('admin')->id() != 1 && $request->role == 1) {
            return back()->withErrors(['err_msg' => 'Only the system administrator can create a user with super admin role']);
        }
        $admin = new Admin;
        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->email = $request->email;
        $admin->role = $request->role;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return back()->with('success', 'New administrator has been added.');
    }

    public function updateAdmin($id, Request $request)
    {
        $this->validate($request, [
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique((new Admin)->getTable())->ignore($id)],
            'role' => ['required', 'integer', 'exists:admin_roles,id'],
        ]);
        $admin = Admin::find($id);
        $admin->update($request->except('_token'));
        return back()->with('success', 'Admin profile has been updated.');
    }

    public function updateAdminPassword($id, Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
        $admin = Admin::find($id);
        $admin->update(['password' => Hash::make($request->get('password'))]);
        #Mail::to(auth('admin')->user()->email)->send(new SendPasswordChange($admin->firstname));
        return back()->with('success', 'Password successfully updated.');
    }

    public function deleteAdmin($id)
    {
        if ($id == 1 || $id == auth('admin')->id() || auth('admin')->user()->role != 1) {
            return back()->withErrors(['adm_err' => 'Administrator cannot be deleted']);
        }
        $admin = Admin::find($id);
        if ($admin->role == 1 && auth('admin')->id() != 1) {
            return back()->withErrors(['adm_err' => 'Only the system administrator can delete a super admin.']);
        }
        $admin->delete();
        return back()->with('success', 'Administrator has been deleted');
    }

    public function states()
    {
        $states = State::orderBy('name')->paginate(10);
        return view('admin.settings.states', compact('states'));
    }

    public function cities()
    {
        if (isset($_GET['state'])) {
            $stateId = $_GET['state'];
            $state = State::find($stateId);
            $cities = City::where('state_id', $state->id)->orderBy('state_id')->paginate(10);
            return view('admin.settings.cities', compact('state', 'cities'));
        }
        $cities = City::orderBy('state_id')->orderBy('name')->paginate(10);
        return view('admin.settings.cities', compact('cities'));
    }

    public function city($id)
    {
        $states = State::all();
        if ($id == 'new') {
            return view('admin.settings.city', compact('states'));
        }
        $city = City::find($id);
        return view('admin.settings.city', compact('states', 'city'));
    }

    public function newCity(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'state' => ['required', 'integer', 'exists:states,id']
        ]);
        $city = new City();
        $city->name = $request->name;
        $city->state_id = $request->state;
        if ($city->save()) {
            return back()->with('success', 'New city has been added');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again.']);
    }

    public function updateCity($id, Request $request)
    {
        $city = City::find($id);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'state' => ['required', 'integer', 'exists:states,id']
        ]);
        $city->name = $request->name;
        $city->state_id = $request->state;
        if ($city->save()) {
            return back()->with('success', 'City details has been updated');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again.']);
    }

    public function subPacks()
    {
        $packages = Package::all();
        return view('admin.settings.packages', compact('packages'));
    }

    public function subPack($id)
    {
        $package = Package::find($id);
        return view('admin.settings.package', compact('package'));
    }

    public function subPackUpdate($id, Request $request)
    {
        $package = Package::find($id);
        $this->validate($request, [
            'type'=> ['required', 'string', 'max:10'],
            'amount'=> ['required', 'numeric'],
            'duration'=> ['required', 'integer'],
            'description'=> ['nullable', 'string', 'max:2000'],
            'status'=> ['required', 'integer'],
        ]);
        $package->update($request->except('_token'));
        return back()->with('success', 'Package details has been updated');
    }

    public function adverts()
    {
        $adverts = Advert::all();
        return view('admin.settings.adverts', compact('adverts'));
    }

    public function advert($id)
    {
        $advert = Advert::find($id);
        return view('admin.settings.advert', compact('advert'));
    }

    public function advertUpdate($id, Request $request)
    {
        $advert = Advert::find($id);
        $this->validate($request, [
            'title'=> ['required', 'string', 'max:255'],
            /*'width'=> ['required', 'numeric'],
            'height'=> ['required', 'numeric'],*/
            'cost'=> ['required', 'numeric'],
            'image'=> ['nullable', 'image', 'mimes:jpg,png,jpeg', Rule::dimensions()->width($advert->width)->height($advert->height)],
            'url' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:20'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
        $advertData = $request->except(['_token', 'image']);
        if ($request->has('image')) {
            if (Storage::exists('public/advert/'.$advert->image)) {
                Storage::delete('public/advert/'.$advert->image);
            }
            $imgFileName =  Str::random(32) . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('advert', $imgFileName, 'public');
            $advertData = array_merge($advertData, ['image' => $imgFileName]);
        }
        $advert->update($advertData);
        return back()->with('success', 'Advert details has been updated');
    }

    public function plugview(Request $request)
    {
        if($request->method() == 'POST')
        {
            $this->validate($request, [
                'default' => ['required', 'string', 'max:7'],
                'youtube' => ['required_if:default,youtube', 'nullable', 'url'],
                'mp4' => ['required_if:default,mp4', 'nullable', 'mimes:mp4', 'max:5120']
            ]);
            $plugview1 = DB::table('api_data')->where('name', 'plugview')->where('token_type', 'default');
            $plugview2 = DB::table('api_data')->where('name', 'plugview')->where('token_type', $request->default);
            $videoUrl = $this->getYoutubeEmbedUrl($request->{$request->default});
            if ($plugview1->first()) {
                $plugview1->update([
                    'access_token'  => $request->default, 
                    'updated_at'    => now()
                ]);
                if ($request->has('mp4')) {
                    if(isset($plugview2->first()->access_token)) {
                        if (Storage::exists('public/plugview/'.$plugview2->first()->access_token)) {
                            Storage::delete('public/plugview/'.$plugview2->first()->access_token);
                        }
                    }
                    $videoUrl = $request->file('mp4')->store('plugview', 'public');;
                }
                if ($plugview2->first()) {
                    $plugview2->update([
                        'token_type'    => $request->default, 
                        'access_token'  => $videoUrl, 
                        'updated_at'    => now()
                    ]); 
                }
                return back()->with('success', 'Plugview Newsroom video has been updated');
            }
            return back()->with('success', 'Plugview Newsroom video has been updated');
        }
        $plugview = DB::table('api_data')->where('name', 'plugview')->get()->keyBy('token_type');
        return view('admin.settings.plugview', compact('plugview'));
    }

    private function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        if (!isset($youtube_id)) {
            return '';
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }
}
