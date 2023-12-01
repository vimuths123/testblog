<?php

namespace App\Repositories;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogRepository implements BlogRepositoryInterface
{
    public function all(int $perPage = 10)
    {
        // Fetch blogs with published_date not null
        $blogs = Blog::latest()
            ->whereNotNull('published_date')
            ->paginate($perPage);

        // Transform the result to a LengthAwarePaginator instance
        return new LengthAwarePaginator(
            $blogs->items(),
            $blogs->total(),
            $blogs->perPage(),
            $blogs->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }

    public function find($id)
    {
        return Blog::findOrFail($id);
    }

    public function latestExceptCurrent($currentBlog, $count = 4)
    {
        return Blog::where('id', '!=', $currentBlog->id)
            ->latest()
            ->whereNotNull('published_date')
            ->take($count)
            ->get();
    }

    public function create(array $data)
    {
        return Blog::create(array_merge($data, ['user_id' => auth()->id()]));
    }

    public function getUserBlogs($userId)
    {
        return Blog::where('user_id', $userId)->get();
    }

    public function update($id, array $data)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($data);

        return $blog;
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
    }
}
