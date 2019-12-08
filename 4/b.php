<?php

	function passwordMeetsCriteria($number) {
		$hasStrictlyDouble = false;

		$digits = str_split($number);
		for ($i = 1; $i < count($digits); $i++) {
			if ($digits[$i] < $digits[$i - 1]) {
				return false;
			}

			if (($i === 1 && $digits[$i] == $digits[$i - 1] && $digits[$i] != $digits[$i + 1])
				|| ($i > 1 && $i < 5 && $digits[$i] == $digits[$i - 1] && $digits[$i] != $digits[$i - 2] && $digits[$i] != $digits[$i + 1])
				|| ($i === 5 && $digits[$i] == $digits[$i - 1] && $digits[$i] != $digits[$i - 2])) {
				$hasStrictlyDouble = true;
			}
		}

		return $hasStrictlyDouble;
	}

	$numPasswordsMeetingCriteria = 0;
	for ($password = 264360; $password <= 746325; $password++) {
		if (passwordMeetsCriteria($password)) {
			$numPasswordsMeetingCriteria++;
		}
	}

	echo "Number of Passwords Meeting Criteria: {$numPasswordsMeetingCriteria}\n";
