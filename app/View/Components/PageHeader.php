<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
	private string $pretitle;
	private string $title;

	public function __construct(string $pretitle = '', string $title = '')
	{

		$this->pretitle = $pretitle;
		$this->title = $title;
	}

	public function render(): View
	{
		return view('components.page-header', [
			'pretitle' => $this->pretitle,
			'title' => $this->title
		]);
	}
}
