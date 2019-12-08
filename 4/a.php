<?php

	function passwordMeetsCriteria($number) {
		$hasDouble = false;

		$digits = str_split($number);
		for ($i = 1; $i < count($digits); $i++) {
			if ($digits[$i] < $digits[$i - 1]) {
				return false;
			}

			if ($digits[$i] == $digits[$i - 1]) {
				$hasDouble = true;
			}
		}

		return $hasDouble;
	}

	$numPasswordsMeetingCriteria = 0;
	for ($password = 264360; $password <= 746325; $password++) {
		if (passwordMeetsCriteria($password)) {
			$numPasswordsMeetingCriteria++;
		}
	}

	echo "Number of Passwords Meeting Criteria: {$numPasswordsMeetingCriteria}\n";
