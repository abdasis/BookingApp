<?php

namespace App\Providers;

use App\Interfaces\BookingRepsitoryInterface;
use App\Interfaces\VoucherRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\VoucherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(
			VoucherRepositoryInterface::class,
			VoucherRepository::class
		);

		$this->app->bind(
			BookingRepsitoryInterface::class,
			BookingRepository::class
		);
	}

	public function boot(): void
	{
	}
}
