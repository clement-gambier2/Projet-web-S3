<?php

class Security {

	private static $seed = 'G599UPYwiW47fgn';

	public static function hacher($texte_en_clair) {
		$texte_hache = hash('sha256', $texte_en_clair);
		return $texte_hache;
	}

	public static function generateRandomHex() {
		// Generate a 32 digits hexadecimal number
		$numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
		$bytes = openssl_random_pseudo_bytes($numbytes); 
		$hex   = bin2hex($bytes);
		return $hex;
	  }

}

?>