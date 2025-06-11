<?php

namespace App\Http\Controllers\Admin\THC;

use App\Http\Controllers\Controller;
use App\Models\THC\AbuseReport;
use Illuminate\Http\Request;

class AbuseReportController extends Controller
{
    public function index()
    {
        $abuse_reports = AbuseReport::orderByDesc('created_at')->paginate(10);
        return view('admin.thc.abuse_reports.index', compact('abuse_reports'));
    }

    public function get($id)
    {
        $abuse_report = AbuseReport::find($id);
        return view('admin.thc.abuse_reports.single', compact('abuse_report'));
    }
}
