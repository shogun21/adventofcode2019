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

	$intersections = array_fill_keys(array_intersect($coordinates[0], $coordinates[1]), true);

	$stepsToIntersection = array_fill(0, 2, null);
	foreach ($wires as $i => $wire) {
		$x = 0;
		$y = 0;
		$totalSteps = 0;

		foreach ($wire as $path) {
			$direction = $path[0];
			$steps = substr($path, 1);

			for ($step = 0; $step < $steps; $step++) {
				$totalSteps++;

				if ($direction == 'U') {
					$y++;
				} else if ($direction == 'D') {
					$y--;
				} else if ($direction == 'L') {
					$x--;
				} else if ($direction == 'R') {
					$x++;
				}

				if (isset($intersections["{$x},{$y}"])) {
					$stepsToIntersection[$i]["{$x},{$y}"] = $totalSteps;
				}
			}
		}
	}

	$combinedStepsToIntersection = [];
	foreach ($intersections as $intersection => $t) {
		$combinedStepsToIntersection[] = $stepsToIntersection[0][$intersection] + $stepsToIntersection[1][$intersection];
	}

	echo "Minimum Steps to Intersection: ".(min($combinedStepsToIntersection))."\n";

	fclose($input);
