<?php


function rupiah(float $nilai = 0)
{
	if ($nilai !== '') {
		$nilai = round($nilai ?? 0, 0, PHP_ROUND_HALF_UP);
		$formated = number_format($nilai, 0, ',', '.');
		if ($nilai >= 0) {
			return $formated;
		}
		$remove_strip = str_replace('-', '', $formated);
		return "(".$remove_strip.")";
	}
	return 0;
}
