<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

	public function __construct()
	{

	}

	public function index(Request $request): View
	{
		$permission = Permission::get();
		$roles = Role::orderBy('id', 'DESC')->paginate(5);
		return view('roles.index', compact('roles', 'permission'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function store(Request $request): RedirectResponse
	{
		$this->validate($request, [
			'name' => 'required|unique:roles,name',
			'permission' => 'required',
		]);
		$role = Role::create(['name' => $request->input('name')]);
		$role->syncPermissions($request->input('permission'));
		return redirect()->route('roles.index')
			->with('success', 'Role created successfully');
	}

	public function create(): View
	{
		$permission = Permission::get();
		return view('roles.create', compact('permission'));
	}

	public function show($id): View
	{
		$role = Role::find($id);
		$rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
			->where("role_has_permissions.role_id", $id)
			->get();

		return view('roles.show', compact('role', 'rolePermissions'));
	}


	public function edit($id): View
	{
		$role = Role::find($id);
		$permission = Permission::get();
		$rolePermissions = DB::table("role_has_permissions")
			->where("role_has_permissions.role_id", $id)
			->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
			->all();

		return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
	}

	public function update(Request $request, $id): RedirectResponse
	{
		$this->validate($request, [
			'name' => 'required',
			'permission' => 'required',
		]);

		$role = Role::find($id);
		$role->name = $request->input('name');
		$role->save();

		$role->syncPermissions($request->input('permission'));

		return redirect()->route('roles.index')
			->with('success', 'Role updated successfully');
	}


	public function destroy($id): RedirectResponse
	{
		DB::table("roles")->where('id', $id)->delete();
		return redirect()->route('roles.index')
			->with('success', 'Role deleted successfully');
	}
}
