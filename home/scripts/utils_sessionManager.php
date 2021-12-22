<?php

// When everithing is OK (loggedIn, no password problem...)
function sessionOK($dbh){
    $_SESSION['initiated'] = TRUE;

    $user = utilisateur::getUtilisateur($dbh,$_SESSION['login']);

    $_SESSION['loggedIn'] = TRUE;

    $_SESSION['nom'] = $user->nom;
    $_SESSION['prenom'] = $user->prenom;
    $_SESSION['naissance'] = $user->naissance;
    $_SESSION['email'] = $user->email;
    $_SESSION['login'] = $user->login;

    $_SESSION['wrongPwd'] = FALSE;
    $_SESSION['wrongRegister'] = FALSE;
    $_SESSION['wrongRegisterLogin'] = FALSE;
    $_SESSION['wrongOldPassword'] = FALSE;

    $_SESSION['newMember'] = FALSE;
    $_SESSION['detailsChanged'] = FALSE;
    $_SESSION['signedOut'] = FALSE;

    $_SESSION['wrongSurveyCreated'] = FALSE;
    $_SESSION['newSurveyCreated'] = FALSE;
    $_SESSION['surveyid'] = 0;
    $_SESSION['showVoteAuthorized'] = FALSE;

    $_SESSINON['hasVoted'] = FALSE;

    $_POST = null;
}

function sessionLogOut() {
    unset($_SESSION['nom']);
    unset($_SESSION['prenom']);
    unset($_SESSION['naissance']);
    unset($_SESSION['email']);
    unset($_SESSION['login']);

    unset($_SESSION['wrongPwd']);
    unset($_SESSION['wrongRegister']);
    unset($_SESSION['wrongRegisterLogin']);
    unset($_SESSION['wrongOldPassword']);

    unset($_SESSION['wrongSurvey']);
    unset($_SESSION['newSurvey']);
    unset($_SESSION['surveyid']);

    unset($_SESSION['newMember']);
    unset($_SESSION['detailsChanged']);
    unset($_SESSION['signedOut']);

    unset($_SESSION['hasVoted']);
}