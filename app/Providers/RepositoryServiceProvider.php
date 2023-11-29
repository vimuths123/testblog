<?php

// app/Providers/RepositoryServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\BlogRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
    }
}

