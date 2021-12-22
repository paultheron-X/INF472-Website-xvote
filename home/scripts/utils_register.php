<?php
function register($dbh) {

    $problemLogin = FALSE;
    if (isset($_POST["login"]) && $_POST["login"] != "" &&
        utilisateur::getUtilisateur($dbh,$_POST['login']) != null) {
        $problemLogin = TRUE;
    }


    if (!$problemLogin &&
        isset($_POST["nom"]) && $_POST["nom"] != "" &&
        isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
        isset($_POST["naissance"]) && $_POST["naissance"] != "" &&
        verifyDate($_POST["naissance"]) &&
        isset($_POST["email"]) && $_POST["email"] != "" &&
        isset($_POST["login"]) && $_POST["login"] != "" &&
        isset($_POST["pwd1"]) && $_POST["pwd1"] != "" &&
        isset($_POST["pwd2"]) && $_POST["pwd2"] != "" &&
        $_POST["pwd1"] == $_POST["pwd2"]) {
        
        $login = $_POST["login"];
        $mdp = $_POST["pwd1"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $naissance = $_POST["naissance"];
        $email = $_POST["email"];
        
        utilisateur::insererUtilisateur($dbh,$login,$mdp,$nom,$prenom,$naissance,$email);

        // Mise à jour de la session
        $_SESSION['login'] = $login;
        sessionOK($dbh);


        return TRUE;

    }
    else {
        $_SESSION['wrongRegister'] = TRUE;
    }

    $_SESSION['wrongRegisterLogin'] = $problemLogin;
    return FALSE;

}


?>