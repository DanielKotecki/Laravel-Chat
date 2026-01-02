<?php

namespace App\Providers;

use App\Repositories\AgeRangeRepository;
use App\Repositories\AgeRangeRepositoryInterface;
use App\Repositories\chat\ChatRepository;
use App\Repositories\chat\ChatRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\UserChatRepository;
use App\Repositories\UserChatRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(AgeRangeRepositoryInterface::class, AgeRangeRepository::class);
        $this->app->bind(UserChatRepositoryInterface::class, UserChatRepository::class);
        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
