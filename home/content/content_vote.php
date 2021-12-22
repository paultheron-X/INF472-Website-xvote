<?php
// Si on arrive ici, c'est nécessairement que
        // - Les clés ont étées vérifiées ;
        // - Le vote est actif.


$survey = survey::getSurvey($dbh,$_GET['voteId']);
$voter = voters::getVoter($dbh,$_GET['voterId']);

// Mise à jour du vote
checkEndDate($dbh,$survey);

if (results::hasVoted($dbh,$voter->voterid)){
        require("home/dynamicContent/dynamicContent_hasAlreadyVoted.php");
}
elseif (! survey::isAvailableToVote($dbh,$_GET['voteId'])) {
        require("home/dynamicContent/dynamicContent_voteFinished.php");
}
else{
        require("home/dynamicContent/dynamicContent_formVote.php");
}
