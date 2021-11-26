<?php

class Security {

	private static $seed = 'G599UPYwiW47fgn';

	public static function hacher($texte_en_clair) {
		$texte_hache = hash('sha256', $texte_en_clair);
		return $texte_hache;
	}

}

?>