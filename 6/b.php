<?php

	$input = fopen('input', 'r');

	$nodes = ['COM' => null];
	$youPlanet = null;
	$santaPlanet = null;
	while (($line = fgets($input)) !== false) {
		$components = explode(')', trim($line));

		if ($components[1] === 'YOU') {
			$youPlanet = $components[0];
		}

		if ($components[1] === 'SAN') {
			$santaPlanet = $components[0];
		}

		$nodes[$components[1]] = $components[0];
	}

	$mySteps = 1;
	$current = $nodes[$youPlanet];
	$myPathNodes = [];
	while (($current = $nodes[$current]) !== null) {
		$myPathNodes[$current] = ++$mySteps;
	}

	$santasSteps = 1;
	$current = $nodes[$santaPlanet];
	$santasPathNodes = [];
	while (($current = $nodes[$current]) !== null) {
		$santasPathNodes[$current] = ++$santasSteps;
	}

	$firstIntersect = key(array_intersect_key($myPathNodes, $santasPathNodes));

	echo "Steps to Santa: ".($myPathNodes[$firstIntersect] + $santasPathNodes[$firstIntersect])."\n";

	fclose($input);