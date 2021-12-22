<?php
function signOut($dbh) {

    $problemOldPassword = TRUE;
    $user = utilisateur::getUtilisateur($dbh,$_SESSION['login']);
    if (isset($_POST["oldPwd"]) && utilisateur::testerMdp($user,$_POST['oldPwd'])) {
        $problemOldPassword = FALSE;
    }


    if (!$problemOldPassword) {
        utilisateur::supprimerUtilisateur($dbh,$_SESSION['login']);
        $_SESSION['wrongOldPassword'] = FALSE;
        return TRUE;
    }
    else {
        $_SESSION['wrongOldPassword'] = TRUE;
    }
    return FALSE;

}


?>