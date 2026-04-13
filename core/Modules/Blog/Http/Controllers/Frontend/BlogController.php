<?php

namespace Modules\Blog\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogComment;
use Modules\Blog\Entities\BlogPost;
use Modules\Service\Entities\Category;

class BlogController extends Controller
{
    public function blog(Request $request)
    {
        $query = BlogPost::with('category')->latest()->where('status', 1);

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'LIKE', '%'.$request->search.'%');
        }

        $blogs = $query->paginate(10);
        $categories = Category::select('id', 'category', 'status')
            ->where('status', 1)
            ->withCount('blogs')
            ->get();

        return view('blog::frontend.blogs.blogs', compact('blogs', 'categories'));
    }

    public function blog_filter(Request $request)
    {
        $category = $request->category;
        if ($category == '') {
            $blogs = BlogPost::with('category')->latest()
                ->where('status', 1)
                ->paginate(10);
        } else {
            $blogs = BlogPost::with('category')->latest()
                ->where('category_id', $category)
                ->where('status', 1)
                ->paginate(10);
        }

        return $blogs->count() >= 1 ? view('blog::frontend.blogs.search-result', compact(['blogs', 'category']))->render() : response()->json(['status' => 'nothing']);
    }

    // pagination
    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $category = $request->category;
            if ($category == 'all') {
                $blogs = BlogPost::latest()->where('status', 1)->paginate(10);
            } else {
                $blogs = BlogPost::latest()
                    ->where('category_id', $category)
                    ->where('status', 1)
                    ->paginate(10);
            }

            return view('blog::frontend.blogs.search-result', compact('blogs'))->render();
        }
    }

    // details
    public function blog_details($slug)
    {
        $blog_details = BlogPost::with([
            'meta_data',
            'author',
            'comments' => function ($query) {
                $query->where('status', 1)->latest();
            },
            'comments.user',
        ])->withCount([
            'comments as approved_comments_count' => function ($q) {
                $q->where('status', 1);
            },
        ])->where('slug', $slug)->firstOrFail();

        $related_blogs = BlogPost::with('category')->where('category_id', $blog_details->category_id)->latest()->take(2)->get();
        $categories = Category::select('id', 'category', 'status')->where('status', 1)->withCount('blogs')->get();
        $blogs = BlogPost::where('status', 1)->paginate(10);

        return view('blog::frontend.blogs.blog-details', compact(['blog_details', 'related_blogs', 'categories', 'blogs']));
    }

    // blog comments
    public function store_comment(Request $request)
    {
        $request->validate([
            'blog_post_id' => 'required|exists:blog_posts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        BlogComment::create([
            'blog_post_id' => $request->blog_post_id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 1,
        ]);
        toastr_success(__('Comment Successfully Added'));

        return redirect()->back();
    }
}
