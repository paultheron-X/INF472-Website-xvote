<?php


function insererVote($dbh, $surveyid, $voterid){
    if (survey::getSurvey($dbh,$surveyid)->type == 'Scrutin uninomial') {
        if (isset($_POST['vote']) && $_POST['vote']!= null) {
            results::insererResult($dbh, $voterid, $_POST['vote'], $surveyid);
        }
    }
    if (survey::getSurvey($dbh,$surveyid)->type == 'Méthode de Borda') {
        if (isset($_POST['position']) && $_POST['position']!= null) {
            $arrayResults = explode('"',$_POST['position']);
            $n = count($arrayResults);
            $finalVote = "";

            for ($i=0; $i < $n; $i++){
                if ($i % 2 == 1) {
                    $finalVote = $finalVote . '&#&' . $arrayResults[$i];
                }
            }

            results::insererResult($dbh, $voterid, $finalVote, $surveyid);
        }
    }
}
