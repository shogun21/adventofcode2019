<?php

	$input = fopen('input', 'r');

	$nodes = ['COM' => null];
	while (($line = fgets($input)) !== false) {
		$components = explode(')', trim($line));

		$nodes[$components[1]] = $components[0];
	}


	$steps = 0;
	foreach ($nodes as $child => $parent) {
		$current = $child;

		while (($current = $nodes[$current]) !== null) {
			$steps++;
		}
	}

	echo "Total Orbitals: {$steps}\n";

	fclose($input);