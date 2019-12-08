<?php

	$input = fopen('input', 'r');

	$width = 25;
	$height = 6;

	$pixelsInLayer = $width * $height;

	$pixelIndex = 0;
	$layerIndex = 0;

	$layers = [];
	$finalImage = array_fill(1, $pixelsInLayer, null);
	while (($pixel = fgetc($input)) !== false) {
		if (!isset($layers[$layerIndex])) {
			$layers[$layerIndex] = [];
		}

		if ($pixel == '0' && $finalImage[$pixelIndex] === null) {
			$finalImage[$pixelIndex] = ' ';
		} else if ($pixel == '1' && $finalImage[$pixelIndex] === null) {
			$finalImage[$pixelIndex] = 'x';
		}

		if ($pixelIndex === $pixelsInLayer) {
			$pixelIndex = 0;
			$layerIndex++;
		}

		$pixelIndex++;
	}

	foreach ($finalImage as $i => $pixel) {
		echo $pixel;

		if ($i%$width === 0) {
			echo "\n";
		}
	}

	fclose($input);
