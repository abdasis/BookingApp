<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\WahanaBooking;
use App\Policies\WahanaBookingPolicy;
use App\Policies\WahanaPolicy;
use App\Wahana;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
	    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
	    Wahana::class => WahanaPolicy::class,
	    WahanaBooking::class => WahanaBookingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
