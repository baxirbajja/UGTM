<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        $posts = Post::query()
            ->where('is_published', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(12);

        $memos = Post::whereHas('category', function ($query) {
                $query->where('slug', 'memos');
            })
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('search.index', compact('posts', 'query', 'memos'));
    }
}
