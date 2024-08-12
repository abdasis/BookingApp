<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorMessage extends Component
{
	private $error;

	public function __construct($error)
	{
		$this->error = $error;
	}

	public function render(): View
	{

		return view('components.error-message', [
			'error' => $this->error
		]);
	}
}
