<?php
function newSurvey($dbh) {

    if (isset($_POST["type"]) && ($_POST["type"] == 'Scrutin uninomial' || $_POST["type"] == 'Méthode de Borda') &&
        isset($_POST["enddate"]) && $_POST["enddate"] != "" &&
        isset($_POST["endtime"]) && $_POST["endtime"] != "" &&
        verifyDateTime($_POST["enddate"].' '.$_POST["endtime"]) &&
        isset($_POST["surveyname"]) && $_POST["surveyname"] != "" &&
        isset($_POST["description"]) && $_POST["description"] != "" ) {
        
        $type = $_POST["type"];
        $login = $_SESSION["login"];
        $enddate = $_POST["enddate"].' '.$_POST["endtime"].':00';
        $surveyname = $_POST["surveyname"];
        $description = $_POST["description"];
        $status = 0;
        $options = "";


        // Insertion du sondage
        survey::insererSurvey($dbh, $type, $login, $enddate, $surveyname, $description, $status, $options);

        // Chargement du surveyid
        $mySurveyid = survey::getLastSurveyid($dbh, $_SESSION['login']);


        // Mise à jour de la session
        sessionOK($dbh);
        $_SESSION['wrongSurvey'] = FALSE;
        $_SESSION['surveyid'] = $mySurveyid;

        return TRUE;

    }
    else {
        $_SESSION['wrongSurvey'] = TRUE;

        return FALSE;
    }
}