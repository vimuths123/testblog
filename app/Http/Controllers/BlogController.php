<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\BlogRepositoryInterface;

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
        return view('blogs.single', compact('blog'));
    }

}
