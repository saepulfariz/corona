<?php

	class Colors {
		private $foreground_colors = array();
		private $background_colors = array();

		public function __construct() {
			// Set up shell colors
			$this->foreground_colors['black'] = '0;30';
			$this->foreground_colors['dark_gray'] = '1;30';
			$this->foreground_colors['blue'] = '0;34';
			$this->foreground_colors['light_blue'] = '1;34';
			$this->foreground_colors['green'] = '0;32';
			$this->foreground_colors['light_green'] = '1;32';
			$this->foreground_colors['cyan'] = '0;36';
			$this->foreground_colors['light_cyan'] = '1;36';
			$this->foreground_colors['red'] = '0;31';
			$this->foreground_colors['light_red'] = '1;31';
			$this->foreground_colors['purple'] = '0;35';
			$this->foreground_colors['light_purple'] = '1;35';
			$this->foreground_colors['brown'] = '0;33';
			$this->foreground_colors['yellow'] = '1;33';
			$this->foreground_colors['light_gray'] = '0;37';
			$this->foreground_colors['white'] = '1;37';

			$this->background_colors['black'] = '40';
			$this->background_colors['red'] = '41';
			$this->background_colors['green'] = '42';
			$this->background_colors['yellow'] = '43';
			$this->background_colors['blue'] = '44';
			$this->background_colors['magenta'] = '45';
			$this->background_colors['cyan'] = '46';
			$this->background_colors['light_gray'] = '47';
		}

		// Returns colored string
		public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";

			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}

			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";

			return $colored_string;
		}

		// Returns all foreground color names
		public function getForegroundColors() {
			return array_keys($this->foreground_colors);
		}

		// Returns all background color names
		public function getBackgroundColors() {
			return array_keys($this->background_colors);
		}
	}


	// Create new Colors class
	$colors = new Colors();

	// Test some basic printing with Colors class
	echo $colors->getColoredString("Testing Colors class, this is purple string on yellow background.", "purple", "yellow") . "\n";
	echo $colors->getColoredString("Testing Colors class, this is blue string on light gray background.", "blue", "light_gray") . "\n";
	echo $colors->getColoredString("Testing Colors class, this is red string on black background.", "red", "black") . "\n";
	echo $colors->getColoredString("Testing Colors class, this is cyan string on green background.", "cyan", "green") . "\n";
	echo $colors->getColoredString("Testing Colors class, this is cyan string on default background.", "cyan") . "\n";
	echo $colors->getColoredString("Testing Colors class, this is default string on cyan background.", null, "cyan") . "\n";



		// Create new Colors class
		$colors = new Colors();

		// Get Foreground Colors
		$fgs = $colors->getForegroundColors();
		// Get Background Colors
		$bgs = $colors->getBackgroundColors();

		// Loop through all foreground and background colors
		
		/*
		$count = count($fgs);
		for ($i = 0; $i < $count; $i++) {
			echo $colors->getColoredString("Test Foreground colors", $fgs[$i]) . "\t";
			if (isset($bgs[$i])) {
				echo $colors->getColoredString("Test Background colors", null, $bgs[$i]);
			}
			echo "\n";
		}
		echo "\n";

		// Loop through all foreground and background colors
		foreach ($fgs as $fg) {
			foreach ($bgs as $bg) {
				echo $colors->getColoredString("Test Colors", $fg, $bg) . "\t";
			}
			echo "\n";
		}
		*/



// https://www.if-not-true-then-false.com/2010/php-class-for-coloring-php-command-line-cli-scripts-output-php-output-colorizing-using-bash-shell-colors/

// red = 0;31
$warna_huruf = "0;31";
$kata_huruf = "zailbaiz";
$ujung_huruf = "\033[0m";
$bg_huruf = "42";
// satu huruf
// ubah warna cmd
echo "\033[". $warna_huruf."m".$kata_huruf.$ujung_huruf;
echo " \n";

// ubah bg dan color cmd
echo "\033[". $warna_huruf."m"."\033[". $bg_huruf."m".$kata_huruf.$ujung_huruf;



?>



