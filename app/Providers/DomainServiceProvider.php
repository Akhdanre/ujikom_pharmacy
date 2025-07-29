<?php

namespace App\Providers;

use App\Domain\Medicine\Repositories\MedicineRepositoryInterface;
use App\Domain\Category\Repositories\CategoryRepositoryInterface;
use App\Domain\Purchase\Repositories\PurchaseTransactionRepositoryInterface;
use App\Domain\Sales\Repositories\SalesTransactionRepositoryInterface;
use App\Domain\Shipping\Repositories\ShippingRepositoryInterface;
use App\Domain\Payment\Repositories\PaymentRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\EloquentMedicineRepository;
use App\Infrastructure\Persistence\EloquentCategoryRepository;
use App\Infrastructure\Persistence\EloquentPurchaseTransactionRepository;
use App\Infrastructure\Persistence\EloquentSalesTransactionRepository;
use App\Infrastructure\Persistence\EloquentShippingRepository;
use App\Infrastructure\Persistence\EloquentPaymentRepository;
use App\Infrastructure\Persistence\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(MedicineRepositoryInterface::class, EloquentMedicineRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(PurchaseTransactionRepositoryInterface::class, EloquentPurchaseTransactionRepository::class);
        $this->app->bind(SalesTransactionRepositoryInterface::class, EloquentSalesTransactionRepository::class);
        $this->app->bind(ShippingRepositoryInterface::class, EloquentShippingRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, EloquentPaymentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
} 