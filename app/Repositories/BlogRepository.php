<?php

namespace App\Repositories;

use App\Models\Blog;

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
}
