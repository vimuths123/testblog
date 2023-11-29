<?php

namespace App\Repositories;

use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function all();

    public function find($id);
}