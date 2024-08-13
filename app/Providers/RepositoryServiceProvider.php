<?php

namespace App\Providers;

use App\Interfaces\VoucherRepositoryInterface;
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
	}

	public function boot(): void
	{
	}
}
