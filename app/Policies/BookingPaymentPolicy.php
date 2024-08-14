<?php

namespace App\Policies;

use App\Models\BookingPayment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPaymentPolicy
{
	use HandlesAuthorization;

	public function viewAny(User $user): bool
	{

	}

	public function view(User $user, BookingPayment $bookingPayment): bool
	{
	}

	public function create(User $user): bool
	{
	}

	public function update(User $user, BookingPayment $bookingPayment): bool
	{
	}

	public function delete(User $user, BookingPayment $bookingPayment): bool
	{
	}

	public function restore(User $user, BookingPayment $bookingPayment): bool
	{
	}

	public function forceDelete(User $user, BookingPayment $bookingPayment): bool
	{
	}
}
