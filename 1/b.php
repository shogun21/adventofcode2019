<?php

	$input = fopen('input', 'r');

	$sum = 0;
	while (($line = fgets($input)) !== false) {
		$fuel =  floor(((int) $line) / 3) - 2;

		$totalModuleFuel = $fuel;

		while ($fuel > 0) {
			$fuel = floor($fuel / 3) - 2;
			
			if ($fuel >= 0) {
				$totalModuleFuel += $fuel;
			}
		}

		$sum +=  $totalModuleFuel;
	}

	echo "Sum of Fuel: {$sum}\n";

	fclose($input);