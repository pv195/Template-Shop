<?php

namespace App\Providers;

use App\Repositories\RateRepository;
use App\Interfaces\AdminStatisticRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\BrandRepository;
use App\Repositories\LoginSocialRepository;
use App\Repositories\OrderRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Interfaces\RateRepositoryInterface;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\OrderManagementRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DiscountRepositoryInterface;
use App\Repositories\DiscountRepository;
use App\Interfaces\CheckoutRepositoryInterface;
use App\Repositories\AdminStatisticRepository;
use App\Interfaces\UserStatisticRepositoryInterface;
use App\Repositories\CheckoutRepository;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\OrderManagementRepository;
use App\Interfaces\LoginSocialRepositoryInterface;
use App\Repositories\UserStatisticRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CheckoutRepositoryInterface::class, CheckoutRepository::class);
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderManagementRepositoryInterface::class, OrderManagementRepository::class);
        $this->app->bind(AdminStatisticRepositoryInterface::class, AdminStatisticRepository::class);
        $this->app->bind(UserStatisticRepositoryInterface::class, UserStatisticRepository::class);
        $this->app->bind(LoginSocialRepositoryInterface::class, LoginSocialRepository::class);
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
