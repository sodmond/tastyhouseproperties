<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index() 
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $searchArr = explode(' ', $searchVal);
            $users = User::whereIn('firstname', $searchArr)->orWhereIn('lastname', $searchArr)->orWhere('email', $searchVal)->orderByDesc('created_at')->paginate(10);
            return view('admin.users.index', compact('users'));
        }
        $users = User::orderByDesc('created_at')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function get($id) 
    {
        $user = User::find($id);
        return view('admin.users.single', compact('user'));
    }

    public function export()
    {
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
            $dateObj = DateTime::createFromFormat('!m', $month);
            $monthName = $dateObj->format('F');
            $fileName = 'users-'.$monthName.$year.'.xlsx';
            return Excel::download(new UsersExport($month, $year), $fileName);
        }
        return redirect()->back();
    }

    public function ban($id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->status == true) {
                $user->status = false;
                $user->save();
                return back()->withErrors(['err_msg' => 'User has been banned']);
            }
            $user->status = true;
            $user->save();
            return back()->with('success', 'User ban has been lifted');
        }
        return redirect()->route('admin.home');
    }
}
