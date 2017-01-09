<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Repositories\TagRepository;
use App\Http\Requests;
use App\Notifications\UserRegistered;
use App\Post;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use XblogConfig;


class DatatablesController extends Controller
{
    protected $postRepository;
    protected $tagRepository;
    protected $categoryRepository;
    protected $commentRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(PostRepository $postRepository,
                                CategoryRepository $categoryRepository,
                                TagRepository $tagRepository,
                                CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->commentRepository = $commentRepository;
    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {



    }
}