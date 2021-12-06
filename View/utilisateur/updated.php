<?php
    echo '<p>L utisateur ayant comme pseudo '. $pseudo . ' a bien été modifiée.</p>';
    require_once File::build_path(array("View","utilisateur","list.php"));
?>