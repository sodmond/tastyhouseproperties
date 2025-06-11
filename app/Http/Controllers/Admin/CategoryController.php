<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $all_cats = ProductCategory::orderBy('title')->get()->keyBy('id');
            $categories = ProductCategory::where('title', 'LIKE', "%$searchVal%")->orderBy('title')->paginate(10);
            return view('admin.categories.index', compact('all_cats', 'categories'));
        }
        $all_cats = ProductCategory::orderBy('title')->get()->keyBy('id');
        $categories = ProductCategory::orderBy('title')->paginate(10);
        return view('admin.categories.index', compact('all_cats', 'categories'));
    }

    public function new()
    {
        $categories = ProductCategory::all();
        return view('admin.categories.new', compact('categories'));
    }

    public function newAdd(CategoryRequest $request)
    {
        $category = ProductCategory::create($request->except('_token'));
        if ($category) {
            return back()->with('success', 'New product category has been added.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function edit($id)
    {
        $category = ProductCategory::find($id);
        $categories = ProductCategory::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update($id, CategoryRequest $request)
    {
        $category = ProductCategory::find($id);
        if ($category) {
            $category->update($request->except('_token'));
            return back()->with('success', 'Product category has been updated.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function trash($id)
    {
        return back();
    }
}
