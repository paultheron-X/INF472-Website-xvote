<?php
function changeDetails($dbh) {

    $problemLogin = FALSE;
    if (isset($_POST["login"]) && $_POST["login"] != $_SESSION['login'] && $_POST["login"] != '' &&
        utilisateur::getUtilisateur($dbh,$_POST['login']) != null) {
        $problemLogin = TRUE;
    }

    $problemOldPassword = TRUE;
    $user = utilisateur::getUtilisateur($dbh,$_SESSION['login']);
    if (isset($_POST["oldPwd"]) && utilisateur::testerMdp($user,$_POST['oldPwd'])) {
        $problemOldPassword = FALSE;
    }

    $problemNewPassword = FALSE;
    if (((isset($_POST["pwd1"]) && $_POST["pwd1"] != "") ||
        (isset($_POST["pwd2"]) && $_POST["pwd2"] != "")) &&
        $_POST["pwd1"] != $_POST["pwd2"]) {
        $problemNewPassword = TRUE;
    }


    if (!$problemLogin && !$problemOldPassword && !$problemNewPassword) {
        
        $login = $_POST["login"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $naissance = $_POST["naissance"];
        $email = $_POST["email"];
    
        // Pwd : on regarde s'il faut prendre l'ancien ou le nouveau
        if (isset($_POST['pwd1']) && $_POST['pwd1'] != null) {
            $mdp = $_POST['pwd1'];
        }
        else {
            $mdp = $_POST['oldPwd'];
        }
        // Autres : on regarde s'il faut prendre en compte
        if ($nom == '') {
            $nom = $_SESSION['nom'];
        }
        if ($prenom == '') {
            $prenom = $_SESSION['prenom'];
        }
        if ($naissance == '') {
            $naissance = $_SESSION['naissance'];
        }
        if ($email == '') {
            $email = $_SESSION['email'];
        }

        // Changement sur la BDD
        utilisateur::changerUtilisateur($dbh,$login,$mdp,$nom,$prenom,$naissance,$email);
        
        
        // Mise à jour de la session
        sessionOK($dbh);


        return TRUE;

    }
    else {
        $_SESSION['wrongRegister'] = TRUE;
    }

    $_SESSION['wrongRegisterLogin'] = $problemLogin;
    $_SESSION['wrongOldPassword'] = $problemOldPassword;
    return FALSE;

}


?>