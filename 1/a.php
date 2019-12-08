<?php

	$input = fopen('input', 'r');

	$sum = 0;
	while (($line = fgets($input)) !== false) {
		$sum +=  floor(((int) $line) / 3) - 2;
	}

	echo "Sum of Fuel: {$sum}\n";

	fclose($input);