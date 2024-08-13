<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WahanaBooking;
use Illuminate\Auth\Access\HandlesAuthorization;

class WahanaBookingPolicy
{
	use HandlesAuthorization;

	public function viewAny(User $user): bool
	{

	}

	public function view(User $user, WahanaBooking $wahanaBooking): bool
	{
	}

	public function create(User $user): bool
	{
	}

	public function update(User $user, WahanaBooking $wahanaBooking): bool
	{
	}

	public function delete(User $user, WahanaBooking $wahanaBooking): bool
	{
	}

	public function restore(User $user, WahanaBooking $wahanaBooking): bool
	{
	}

	public function forceDelete(User $user, WahanaBooking $wahanaBooking): bool
	{
	}
}
