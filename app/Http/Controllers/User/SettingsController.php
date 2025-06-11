<?php

namespace App\Http\Controllers\User;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SettingsController extends Controller
{
    public function index()
    {
        $adminRoles = DB::table('admin_roles')->get();
        $admins = Admin::all();
        return view('author.settings', compact('adminRoles', 'admins'));
    }

    /*public function newAdmin(Request $request)
    {
        if (auth('author')->user()->role != 1) {
            return redirect()->route('author.settings');
        }
        $this->validate($request, [
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:admins'],
            'role' => ['required', 'integer'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
        $author = new Admin;
        $author->firstname = $request->firstname;
        $author->lastname = $request->lastname;
        $author->email = $request->email;
        $author->role = $request->role;
        $author->password = Hash::make($request->password);
        $author->save();
        return back()->with('success', 'New administrator has been added.');
    }

    public function deleteAdmin($id)
    {
        if ($id == 1 || $id == auth('admin')->id() || auth('admin')->user()->role != 1) {
            return back()->withErrors(['adm_err' => 'Administrator cannot be deleted']);
        }
        $admin = Admin::find($id);
        $admin->delete();
        return back()->with('success', 'Administrator has been deleted');
    }*/
}
