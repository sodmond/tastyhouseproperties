<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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
            'option_type' => ['required', 'string', 'max:8'],
            'icon' => ['nullable', 'image', 'mimes:png', 'max:512', Rule::dimensions()->minHeight(70)->minWidth(70)->ratio(1/1)]
        ]);
        $categories = json_encode($request->categories);
        $values = json_encode(explode(',', $request->values));
        if(!empty($request->icon)) {
            $imgName = Str::random(32);
            $imgFileName =  $imgName . '.' . $request->file('icon')->extension();
            $request->file('icon')->storeAs('attribute/icon', $imgFileName, 'public');
        }
        $attribute = Attribute::create([
            'title' => $request->title,
            'categories' => $categories,
            'values' => $values,
            'option_type' => $request->option_type,
            'icon' => $imgFileName
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
            $attribute->title = $request->title;
            $attribute->categories = $categories;
            $attribute->values = $values;
            $attribute->option_type = $request->option_type;
            if ($request->has('icon')) {
                if (Storage::exists('public/attribute/icon/'.$attribute->icon)) {
                    Storage::delete('public/attribute/icon/'.$attribute->icon);
                }
                $imgFileName =  Str::random(32) . '.' . $request->file('icon')->extension();
                $request->file('icon')->storeAs('attribute/icon', $imgFileName, 'public');
                $attribute->icon = $imgFileName;
            }
            $attribute->save();
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
