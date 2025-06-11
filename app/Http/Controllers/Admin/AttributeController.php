<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::orderByDesc('created_at')->paginate(10);
        return view('admin.attribute.index', compact('attributes'));
    }

    public function new()
    {
        $categories = ProductCategory::where('level', '<>', 1)->get();
        $all_cats = ProductCategory::orderBy('title')->get()->keyBy('id');
        return view('admin.attribute.new', compact('categories', 'all_cats'));
    }

    public function newAdd(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'integer', 'exists:product_categories,id'],
            'values' => ['required', 'string', 'max:1000'],
            'option_type' => ['required', 'string', 'max:8']
        ]);
        $categories = json_encode($request->categories);
        $values = json_encode(explode(',', $request->values));
        $attribute = Attribute::create([
            'title' => $request->title,
            'categories' => $categories,
            'values' => $values,
            'option_type' => $request->option_type
        ]);
        if ($attribute) {
            return back()->with('success', 'New attribute has been added.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function edit($id)
    {
        $categories = ProductCategory::where('level', '<>', 1)->get();
        $attribute = Attribute::find($id);
        $all_cats = ProductCategory::orderBy('title')->get()->keyBy('id');
        return view('admin.attribute.edit', compact('categories', 'attribute', 'all_cats'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'integer', 'exists:product_categories,id'],
            'values' => ['required', 'string', 'max:1000'],
            'option_type' => ['required', 'string', 'max:8']
        ]);
        $attribute = Attribute::find($id);
        if ($attribute) {
            $categories = json_encode($request->categories);
            $values = json_encode(explode(',', $request->values));
            $attribute->update([
                'title' => $request->title,
                'categories' => $categories,
                'values' => $values,
                'option_type' => $request->option_type
            ]);
            return back()->with('success', 'Attribute details has been updated.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function trash($id)
    {
        $attribute = Attribute::find($id);
        if ($attribute) {
            $attribute->delete();
            return back()->with('success', 'Attribute has been deleted');
        }
        return back()->withErrors(['err_msg', 'Problem encountered, attribute cannot be deleted, pls try again.']);
    }
}
