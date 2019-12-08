<?php

	$input = fopen('input', 'r');
	$initialProgram = explode(',', fgets($input));

	$desiredOutput = 19690720;

	for ($noun = 0; $noun < 99; $noun++) {
		for ($verb = 0; $verb < 99; $verb++) {
			$positions = $initialProgram;

			$positions[1] = $noun;
			$positions[2] = $verb;

			$pointer = 0;
			while ($positions[$pointer] != 99) {
				if ($positions[$pointer] == 1) {
					$positions[$positions[$pointer + 3]] = $positions[$positions[$pointer + 1]] + $positions[$positions[$pointer + 2]];
				} else if ($positions[$pointer] == 2) {
					$positions[$positions[$pointer + 3]] = $positions[$positions[$pointer + 1]] * $positions[$positions[$pointer + 2]];
				}

				$pointer += 4;
			}

			if ($positions[0] == $desiredOutput) {
				break;
			}
		}

		if ($positions[0] == $desiredOutput) {
			break;
		}
	}

	echo (100 * $noun + $verb)."\n";

	fclose($input);
