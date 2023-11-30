<?php

namespace App\Repositories;

use App\Models\Blog;
use Carbon\Carbon;

class BlogRepository implements BlogRepositoryInterface
{
    public function all()
    {
        return Blog::latest()->get();
    }

    public function find($id)
    {
        return Blog::findOrFail($id);
    }

    public function latestExceptCurrent($currentBlog, $count = 4)
    {
        return Blog::where('id', '!=', $currentBlog->id)
            ->latest()
            ->take($count)
            ->get();
    }

    public function create(array $data)
    {
        return Blog::create(array_merge($data, ['user_id' => auth()->id()]));
    }
}
