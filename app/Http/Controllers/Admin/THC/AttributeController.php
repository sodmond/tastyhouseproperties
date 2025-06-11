<?php

namespace App\Http\Controllers\Admin\THC;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\THC\Attribute;
use App\Models\THC\Category;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $addon_groups = Attribute::orderByDesc('created_at')->paginate(10);
        return view('admin.thc.attribute.index', compact('addon_groups'));
    }

    public function new()
    {
        $sellers = Seller::all();
        return view('admin.thc.attribute.new', compact('sellers'));
    }

    public function newAdd(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'option_type' => ['required', 'string', 'max:8'],
            'required' => ['required', 'numeric']
        ]);
        $addon_group = Attribute::create([
            'title' => $request->title,
            'option_type' => $request->option_type,
            'required' => $request->required
        ]);
        if ($addon_group) {
            return back()->with('success', 'New Addon Group has been added.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function edit($id)
    {
        $addon_group = Attribute::find($id);
        return view('admin.thc.attribute.edit', compact('addon_group'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'option_type' => ['required', 'string', 'max:8'],
            'required' => ['required', 'numeric']
        ]);
        $addon_group = Attribute::find($id);
        if ($addon_group) {
            $addon_group->update([
                'title' => $request->title,
                'option_type' => $request->option_type,
                'required' => $request->required,
            ]);
            return back()->with('success', 'Addon Group details has been updated.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function trash($id)
    {
        $addon_group = Attribute::find($id);
        if ($addon_group) {
            $addon_group->delete();
            return back()->with('success', 'Attribute has been deleted');
        }
        return back()->withErrors(['err_msg', 'Problem encountered, attribute cannot be deleted, pls try again.']);
    }
}
