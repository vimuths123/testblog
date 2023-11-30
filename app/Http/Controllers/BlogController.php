<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\BlogRepositoryInterface;
use App\Http\Requests\BlogPostCreateRequest;


class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $blogs = $this->blogRepository->all();
        return view('blogs.list', compact('blogs'));
    }

    public function show($id)
    {
        $blog = $this->blogRepository->find($id);
        $latestBlogs = $this->blogRepository->latestExceptCurrent($blog, 4);
        return view('blogs.single', compact('blog', 'latestBlogs'));
    }

    public function create(){
        return view('blogs.create');
    }
    
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->validated();

        $data = $request->only(['title', 'content']);
        $blog = $this->blogRepository->create($data);

        return redirect()->route('blogs.create', $blog->id)->with('success', 'Blog post created successfully.');
    }
}

