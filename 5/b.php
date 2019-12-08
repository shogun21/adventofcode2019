<?php

	$input = fopen('input', 'r');

	$data = explode(',', fgets($input));

	$pointer = 0;
	while ($data[$pointer] != 99) {
		$instruction = str_pad($data[$pointer], 5, 0, STR_PAD_LEFT);

		$modeFor3rdParameter = $instruction[0];
		$modeFor2ndParameter = $instruction[1];
		$modeFor1stParameter = $instruction[2];
		$opcode = substr($instruction, 3, 2);

		if ($opcode == "01") {
			// Add
			$firstValue = $modeFor1stParameter == 0 ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
			$secondValue = $modeFor2ndParameter == 0 ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

			if ($modeFor3rdParameter == 0) {
				$data[$data[$pointer + 3]] = $firstValue + $secondValue;
			} else {
				$data[$pointer + 3] = $firstValue + $secondValue;
			}

			$pointer += 4;
		} else if ($opcode == "02") {
			// Multiple
			$firstValue = $modeFor1stParameter == 0 ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
			$secondValue = $modeFor2ndParameter == 0 ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

			if ($modeFor3rdParameter == 0) {
				$data[$data[$pointer + 3]] = $firstValue * $secondValue;
			} else {
				$data[$pointer + 3] = $firstValue * $secondValue;
			}

			$pointer += 4;
		} else if ($opcode == "03") {
			// Input
			$data[$data[$pointer + 1]] = 5;

			$pointer += 2;
		} else if ($opcode == "04") {
			// Output
			if ($modeFor3rdParameter == 0) {
				echo "Output: ".$data[$data[$pointer + 1]]."\n";
			} else {
				echo "Output: ".$data[$pointer + 1]."\n";
			}

			$pointer += 2;
		} else if ($opcode == "05") {
			// Jump if True
			$firstValue = $modeFor1stParameter == 0 ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
			$secondValue = $modeFor2ndParameter == 0 ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

			if ($firstValue != 0) {
				$pointer = $secondValue;
			} else {
				$pointer += 3;
			}
		} else if ($opcode == "06") {
			// Jump if False
			$firstValue = $modeFor1stParameter == 0 ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
			$secondValue = $modeFor2ndParameter == 0 ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

			if  ($firstValue == 0) {
				$pointer = $secondValue;
			} else {
				$pointer += 3;
			}
		} else if ($opcode == "07") {
			// Less Than
			$firstValue = $modeFor1stParameter == 0 ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
			$secondValue = $modeFor2ndParameter == 0 ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

			if ($firstValue < $secondValue) {
				if ($modeFor3rdParameter == 0) {
					$data[$data[$pointer + 3]] = 1;
				} else {
					$data[$pointer + 3] = 1;
				}
			} else {
				if ($modeFor3rdParameter == 0) {
					$data[$data[$pointer + 3]] = 0;
				} else {
					$data[$pointer + 3] = 0;
				}
			}

			$pointer += 4;
		} else if ($opcode == "08") {
			// Equals
			$firstValue = $modeFor1stParameter == 0 ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
			$secondValue = $modeFor2ndParameter == 0 ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

			if ($firstValue == $secondValue) {
				if ($modeFor3rdParameter == 0) {
					$data[$data[$pointer + 3]] = 1;
				} else {
					$data[$pointer + 3] = 1;
				}
			} else {
				if ($modeFor3rdParameter == 0) {
					$data[$data[$pointer + 3]] = 0;
				} else {
					$data[$pointer + 3] = 0;
				}
			}
			
			$pointer += 4;
		}

	}

	echo implode(', ', $data)."\n";

	fclose($input);
