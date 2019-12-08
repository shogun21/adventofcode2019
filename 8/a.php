<?php

	$input = fopen('input', 'r');

	$width = 25;
	$height = 6;

	$pixelsInLayer = $width * $height;

	$pixelIndex = 0;
	$layerIndex = 0;

	$layers = [];
	$minZeroLayerIndex = 0;
	$minZeros = PHP_INT_MAX;
	while (($pixel = fgetc($input)) !== false) {
		if (!isset($layers[$layerIndex])) {
			$layers[$layerIndex] = [
				'0' => 0,
				'1' => 0,
				'2' => 0,
			];
		}

		if ($pixel == '0') {
			$layers[$layerIndex]['0']++;
		} else if ($pixel == '1') {
			$layers[$layerIndex]['1']++;
		} else if ($pixel == '2') {
			$layers[$layerIndex]['2']++;
		}

		if ($pixelIndex === $pixelsInLayer) {
			if ($layers[$layerIndex]['0'] < $minZeros) {
				$minZeroLayerIndex = $layerIndex;
				$minZeros = $layers[$layerIndex]['0'];
			}

			$pixelIndex = 0;
			$layerIndex++;
		}

		$pixelIndex++;
	}

	echo "1s * 2s: ".($layers[$minZeroLayerIndex]['1'] * $layers[$minZeroLayerIndex]['2'])."\n";

	fclose($input);
