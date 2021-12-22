<?php
function logIn($dbh){
    $user = utilisateur::getUtilisateur($dbh,$_POST['login']);
    if (utilisateur::testerMdp($user, $_POST['pwd'])) {
        $_SESSION['login'] = $_POST['login'];
        sessionOK($dbh);
    }
    else {
        logOut();
        $_SESSION['wrongPwd'] = TRUE;
    }
}


function logOut() {
    $_SESSION['loggedIn'] = FALSE;
    sessionLogOut();
    $_POST = null;
}
?>