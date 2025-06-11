<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::orderByDesc('created_at')->paginate(10);
        return view('admin.blog.index', compact('blog'));
    }

    public function new()
    {
        return view('admin.blog.new');
    }

    public function addNew(BlogRequest $request)
    {
        $imgName = Str::random(32);
        $imgFileName =  $imgName . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs('blog/image', $imgFileName, 'public');
        $contentFile = time() . '.txt';
        Storage::put('public/blog/contents/'.$contentFile, clean($request->description, 'youtube'));
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = genrateSlug([$request->title]);
        $blog->content = $contentFile;
        $blog->published_at = $request->published_at;
        $blog->image = $imgFileName;
        if ($blog->save()) {
            return back()->with('success', 'New article has been added');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again.']);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update($id, BlogRequest $request)
    {
        $blog = Blog::find($id);
        $contentFile = time() . '.txt';
        Storage::put('public/blog/contents/'.$contentFile, clean($request->description, 'youtube'));
        $blog->title = $request->title;
        $blog->content = $contentFile;
        $blog->published_at = $request->published_at;
        if ($request->has('image')) {
            if (Storage::exists('public/blog/image/'.$blog->image)) {
                Storage::delete('public/blog/image/'.$blog->image);
            }
            $imgFileName =  Str::random(32) . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('blog/image', $imgFileName, 'public');
            $blog->image = $imgFileName;
        }
        if ($blog->save()) {
            return back()->with('success', 'Article details has been updated');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again.']);
    }

    public function trash($id)
    {
        $blog = Blog::find($id);
        if (Storage::exists('public/blog/image/'.$blog->image)) {
            Storage::delete('public/author/blog/image/'.$blog->image);
        }
        if (Storage::exists('public/blog/contents/'.$blog->content)) {
            Storage::delete('public/blog/contents/'.$blog->content);
        }
        $blog->delete();
        return redirect()->route('author.blog')->with('success', 'Blog has been deleted');
    }
}
