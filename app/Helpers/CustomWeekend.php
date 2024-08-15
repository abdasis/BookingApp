<?php

namespace App\Helpers;

use Carbon\Carbon;

class CustomWeekend extends Carbon
{
	public function isWeekend()
	{
		return $this->dayOfWeek === Carbon::FRIDAY || $this->dayOfWeek === Carbon::SATURDAY;
	}

	// Override metode isWeekday
	public function isWeekday()
	{
		return !$this->isWeekend();
	}
}
