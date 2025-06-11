<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsletterExport;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NewsletterController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $newsletters = Newsletter::where('email', 'LIKE', "%$searchVal%")->orderByDesc('created_at')->paginate(10);
            return view('admin.settings.newsletters', compact('newsletters'));
        }
        $newsletters = Newsletter::orderByDesc('created_at')->paginate(10);
        return view('admin.settings.newsletters', compact('newsletters'));
    }

    public function export()
    {
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
            $dateObj = DateTime::createFromFormat('!m', $month);
            $monthName = $dateObj->format('F');
            $fileName = 'newsletters-'.$monthName.$year.'.xlsx';
            return Excel::download(new NewsletterExport($month, $year), $fileName);
        }
        return redirect()->back();
    }
}
