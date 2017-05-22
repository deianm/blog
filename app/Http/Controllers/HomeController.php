<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use App\Post;
use Illuminate\Http\Request;
use XblogConfig;

class HomeController extends Controller
{
    protected $postRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $page_size = XblogConfig::getValue('page_size', 7);
        $posts = $this->postRepository->pagedPosts($page_size);
        return view('post.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $key = $request->get('q');
        $posts = Post::where('title', 'like', "%$key%")->get();
        return view('search', compact('posts'));
    }

    public function projects()
    {
        return view('projects');
    }

    public function achieve()
    {
        $posts = $this->postRepository->achieve();
        $posts_count = $this->postRepository->postCount();
        return view('achieve', compact('posts', 'posts_count'));
    }

}
