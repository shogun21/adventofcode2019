<?php

	$input = fopen('input', 'r');

	$positions = explode(',', fgets($input));

	$pointer = 0;
	while ($positions[$pointer] != 99) {
		if ($positions[$pointer] == 1) {
			$positions[$positions[$pointer + 3]] = $positions[$positions[$pointer + 1]] + $positions[$positions[$pointer + 2]];
		} else if ($positions[$pointer] == 2) {
			$positions[$positions[$pointer + 3]] = $positions[$positions[$pointer + 1]] * $positions[$positions[$pointer + 2]];
		}

		$pointer += 4;
	}

	echo implode(', ', $positions)."\n";

	fclose($input);
