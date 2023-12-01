<?php

namespace App\Repositories;

use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function all(int $perPage);

    public function find($id);

    public function latestExceptCurrent(Blog $currentBlog, $count);

    public function create(array $data);

    public function getUserBlogs($userId);

    public function update($id, array $data);

    public function delete($id);
}