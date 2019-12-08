<?php

	$input = fopen('input', 'r');

	$originalData = explode(',', fgets($input));

	$maxOutput = 0;

	for ($a = 0; $a < 5; $a++) {
		for ($b = 0; $b < 5; $b++) {
			for ($c = 0; $c < 5; $c++) {
				for ($d = 0; $d < 5; $d++) {
					for ($e = 0; $e < 5; $e++) {
						if ($a != $b && $a != $c && $a != $d && $a != $e
							&& $b != $c && $b != $d && $b != $e
							&& $c != $d && $c != $e
							&& $d != $e) {

							$number = "{$a}{$b}{$c}{$d}{$e}";
							$lastOutput = 0;

							$data = $originalData;

							for ($i = 0; $i < 5; $i++) {
								$firstInput = $number[$i];
								$usedFirstInput = false;
								$secondInput = $lastOutput;
								
								$pointer = 0;
								while ($data[$pointer] != 99) {
									$instruction = str_pad($data[$pointer], 5, 0, STR_PAD_LEFT);

									$modeFor3rdParameter = $instruction[0];
									$modeFor2ndParameter = $instruction[1];
									$modeFor1stParameter = $instruction[2];
									$opcode = substr($instruction, 3, 2);

									$firstValue = $modeFor1stParameter == 0 && isset($data[$data[$pointer + 1]]) ? $data[$data[$pointer + 1]] : $data[$pointer + 1];
									$secondValue = $modeFor2ndParameter == 0 && isset($data[$data[$pointer + 2]]) ? $data[$data[$pointer + 2]] : $data[$pointer + 2];

									if ($opcode == "01" || (int) $opcode == 1) {
										// Add
										if ($modeFor3rdParameter == 0) {
											$data[$data[$pointer + 3]] = $firstValue + $secondValue;
										} else {
											$data[$pointer + 3] = $firstValue + $secondValue;
										}

										$pointer += 4;
									} else if ($opcode == "02" || (int) $opcode == 2) {
										// Multiple
										if ($modeFor3rdParameter == 0) {
											$data[$data[$pointer + 3]] = $firstValue * $secondValue;
										} else {
											$data[$pointer + 3] = $firstValue * $secondValue;
										}

										$pointer += 4;
									} else if ($opcode == "03" || (int) $opcode == 3) {
										// Input
										if ($usedFirstInput) {
											$inputValue = $secondInput;
										} else {
											$inputValue = $firstInput;
											$usedFirstInput = true;
										}

										if ($modeFor3rdParameter == 0) {
											$data[$data[$pointer + 1]] = $inputValue;
										} else {
											$data[$pointer + 1] = $inputValue;
										}

										$pointer += 2;
									} else if ($opcode == "04" || (int) $opcode == 4) {
										// Output
										if ($modeFor3rdParameter == 0) {
											$lastOutput = $data[$data[$pointer + 1]];
										} else {
											$lastOutput = $data[$pointer + 1];
										}

										$pointer += 2;
									} else if ($opcode == "05" || (int) $opcode == 5) {
										// Jump if True
										if ($firstValue != 0) {
											$pointer = $secondValue;
										} else {
											$pointer += 3;
										}
									} else if ($opcode == "06" || (int) $opcode == 6) {
										// Jump if False
										if  ($firstValue == 0) {
											$pointer = $secondValue;
										} else {
											$pointer += 3;
										}
									} else if ($opcode == "07" || (int) $opcode == 7) {
										// Less Than
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
									} else if ($opcode == "08" || (int) $opcode == 8) {
										// Equals
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
							}

							if ($lastOutput > $maxOutput) {
								$maxOutput = $lastOutput;
							}
						}
					}
				}
			}
		}
	}

	echo "Max Output: {$maxOutput}\n";

	fclose($input);
