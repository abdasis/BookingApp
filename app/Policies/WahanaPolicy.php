<?php

namespace App\Policies;

use App\Models\User;
use App\Wahana;
use Illuminate\Auth\Access\HandlesAuthorization;

class WahanaPolicy
{
	use HandlesAuthorization;

	public function viewAny(User $user)
	{

	}

	public function view(User $user, Wahana $wahana)
	{
	}

	public function create(User $user)
	{
	}

	public function update(User $user, Wahana $wahana)
	{
	}

	public function delete(User $user, Wahana $wahana)
	{
	}

	public function restore(User $user, Wahana $wahana)
	{
	}

	public function forceDelete(User $user, Wahana $wahana)
	{
	}
}
