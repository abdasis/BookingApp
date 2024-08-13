<?php

namespace App\Interfaces;

interface VoucherRepositoryInterface
{
	public function getAll();

	public function getById(string $id);

	public function getByCode(string $code);

	public function create(array $data);

	public function update($id, array $data);

	public function delete($id);
}
