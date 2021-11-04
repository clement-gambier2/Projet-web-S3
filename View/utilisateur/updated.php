<?php
    echo '<p>L utisateur ayant comme pseudo '. $pseudo . ' a bien été modifiée.</p>';
    require_once File::build_path(array("view","utilisateur","list.php"));
?>