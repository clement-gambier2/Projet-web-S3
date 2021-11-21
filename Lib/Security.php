<?php

class Security {
	public static function hacher($texte_en_clair) {
		$texte_hache = hash('sha256', $texte_en_clair);
		return $texte_hache;
	}
}
?>