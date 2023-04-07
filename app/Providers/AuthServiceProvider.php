<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Coupon;
use App\Models\MaintenancePlaces;
use App\Models\Merchant;
use App\Models\OffersPrices;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Policies\BrandPolicy;
use App\Policies\CouponPolicy;
use App\Policies\MaintenancePlacesPolicy;
use App\Policies\MerchantPolicy;
use App\Policies\OffersPricesPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Brand::class => BrandPolicy::class,
        Coupon::class => CouponPolicy::class,
        MaintenancePlaces::class => MaintenancePlacesPolicy::class,
        Merchant::class => MerchantPolicy::class,
        OffersPrices::class => OffersPricesPolicy::class,
        Order::class => OrderPolicy::class,
        Payment::class => PaymentPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
