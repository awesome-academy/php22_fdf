<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SuggestRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\CategoryEloquentRepository;
use App\Repositories\Eloquents\ProductEloquentRepository;
use App\Repositories\Eloquents\SuggestEloquentRepository;
use App\Repositories\Eloquents\UserEloquentRepository;
use App\Repositories\Contracts\FeedbackRepositoryInterface;
use App\Repositories\Eloquents\FeedbackEloquentRepository;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Eloquents\TransactionEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
        $this->app->bind(SuggestRepositoryInterface::class, SuggestEloquentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductEloquentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryEloquentRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionEloquentRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackEloquentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
