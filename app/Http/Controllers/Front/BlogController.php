<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Blog\BlogService;
use App\Service\Blog\BlogServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class BlogController extends Controller
{

    private $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->all();
        // $recentPosts = DB::table('blogs')->oldest('created_at')->limit(4)->get();
        $recentPosts = $this->blogService->getLatestBlogs();
        return view('front.blog.index', compact('blogs', 'recentPosts'));
    }
    public function show($id)
    {
        $blog = $this->blogService->find($id);
        // $firstBlog = $this->blogService->find(Blog::first()->id);
        // $lastBlog = $this->blogService->find(Blog::orderBy('id', 'desc')->first()->id);
        $firstBlog = Blog::first()->id;
        $lastBlog = Blog::orderBy('id', 'desc')->first()->id;
        if ($id > $firstBlog && $id < $lastBlog) {
            $preBlog = $this->blogService->find($id - 1);
            $nextBlog = $this->blogService->find($id + 1);
        } else if ($id == $firstBlog) {
            $preBlog = $this->blogService->find($firstBlog);
            $nextBlog = $this->blogService->find($id + 1);
        } else if ($id == $lastBlog) {
            $preBlog = $this->blogService->find($id - 1);
            $nextBlog = $this->blogService->find($lastBlog);
        }
        return view('front.blog.show', compact('blog', 'preBlog', 'nextBlog'));
    }
}
