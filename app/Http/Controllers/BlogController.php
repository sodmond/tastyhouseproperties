<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::where('published_at', '<=', now())->orderByDesc('published_at')->paginate(10);
        return view('blog', compact('blog'));
    }

    public function view($id, $slug)
    {
        $blog = Blog::where('id', $id)->where('slug', $slug)->first();
        $recentPosts = Blog::where('published_at', '<=', now())->orderByDesc('published_at')->take(5)->get();
        return view('blog_details', compact('blog', 'recentPosts'));
    }
}
