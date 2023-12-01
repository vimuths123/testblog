<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\BlogRepositoryInterface;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogEditRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

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

    public function create()
    {
        return view('blogs.create');
    }

    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->validated();
        $data = $request->only(['title', 'content']);
        $blog = $this->blogRepository->create($data);

        return redirect()->route('user.blogs', $blog->id)->with('success', 'Blog post created successfully.');
    }

    public function showUserBlogs()
    {
        $userBlogs = $this->blogRepository->getUserBlogs(auth()->id());

        return view('blogs.user_blogs', compact('userBlogs'));
    }

    public function edit($id)
    {
        $blog = $this->blogRepository->find($id);
        $this->authorize('update', $blog);

        return view('blogs.edit', compact('blog'));
    }

    public function update(BlogEditRequest $request, $id)
    {
        $data = $request->validated();
        $blog = $this->blogRepository->update($id, $data);
        $this->authorize('update', $blog);
        return redirect()->route('user.blogs')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        $this->blogRepository->delete($id);
        $blog = $this->blogRepository->find($id);
        $this->authorize('delete', $blog);

        return redirect()->route('user.blogs')->with('success', 'Blog post deleted successfully.');
    }

    public function publish($id)
    {
        $blog = Blog::findOrFail($id);
        $this->authorize('update', $blog);
        $blog->update(['published_date' => Carbon::now()]);

        return redirect()->back()->with('success', 'Blog published successfully.');
    }

    public function unpublish($id)
    {
        $blog = Blog::findOrFail($id);
        $this->authorize('update', $blog);
        $blog->update(['published_date' => null]);

        return redirect()->back()->with('success', 'Blog unpublished successfully.');
    }
}
