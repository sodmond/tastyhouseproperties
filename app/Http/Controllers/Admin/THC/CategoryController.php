<?php

namespace App\Http\Controllers\Admin\THC;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\THC\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $all_cats = Category::orderBy('title')->get()->keyBy('id');
            $categories = Category::where('title', 'LIKE', "%$searchVal%")->orderBy('title')->paginate(10);
            return view('admin.thc.categories.index', compact('all_cats', 'categories'));
        }
        $all_cats = Category::orderBy('title')->get()->keyBy('id');
        $categories = Category::orderBy('title')->paginate(10);
        return view('admin.thc.categories.index', compact('all_cats', 'categories'));
    }

    public function new()
    {
        $categories = Category::all();
        return view('admin.thc.categories.new', compact('categories'));
    }

    public function newAdd(CategoryRequest $request)
    {
        $category = Category::create($request->except('_token'));
        if ($category) {
            return back()->with('success', 'New product category has been added.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, please try again.']);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.thc.categories.edit', compact('category', 'categories'));
    }

    public function update($id, CategoryRequest $request)
    {
        $category = Category::find($id);
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
