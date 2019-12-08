<?php

	$input = fopen('input', 'r');

	$wires = [];
	$wires[] = explode(',', fgets($input));
	$wires[] = explode(',', fgets($input));

	$coordinates = array_fill(0, 2, null);
	foreach ($wires as $i => $wire) {
		$x = 0;
		$y = 0;

		foreach ($wire as $path) {
			$direction = $path[0];
			$steps = substr($path, 1);

			for ($step = 0; $step < $steps; $step++) {
				if ($direction == 'U') {
					$y++;
				} else if ($direction == 'D') {
					$y--;
				} else if ($direction == 'L') {
					$x--;
				} else if ($direction == 'R') {
					$x++;
				}

				$coordinates[$i][] = "{$x},{$y}";
			}
		}
	}

	$manhattanDistances = [];
	foreach (array_intersect($coordinates[0], $coordinates[1]) as $intersect) {
		$coordinate = explode(',', $intersect);

		$manhattanDistances[] = abs($coordinate[0]) + abs($coordinate[1]);
	}

	echo "Minimum Manhattan Distance: ".(min($manhattanDistances))."\n";

	fclose($input);
