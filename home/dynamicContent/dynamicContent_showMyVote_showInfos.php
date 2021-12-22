<?php
switch($survey->status) {
        case 0:
        $myStatus = 'Inactif';
        $actionLink = 'index.php?page=myVotes&todo=showVote&voteAction=startVote&voteId='.$survey->surveyid;
        $actionMessage = 'Démarrer le vote';
        break;
        case 1:
        $myStatus = 'En cours';
        $actionLink = 'index.php?page=myVotes&todo=showVote&voteAction=stopVote&voteId='.$survey->surveyid;
        $actionMessage = 'Terminer le vote';
        break;
        case 2:
        $myStatus = 'Terminé';
        $actionLink = 'index.php?page=myVotes&voteAction=delVote&voteId='.$survey->surveyid;
        $actionMessage = 'Supprimer le vote';
        break;
}
$myName = htmlspecialchars($survey->surveyname);
$myType = htmlspecialchars($survey->type);
$nbVoters = voters::getNbVoters($dbh,$survey->surveyid);
$nbResults = results::getNbResults($dbh,$survey->surveyid);
if ($nbVoters == 0){
    $proportion = 0;
}
else {
    $proportion = round(100*$nbResults/$nbVoters,2);
}

$sendAllLink ='index.php?page=myVotes&todo=showVote&voteAction=sendMailAllVoters&voteId='.$survey->surveyid;
$sendAllMessage = 'envoyer';
$sendRemainingLink ='index.php?page=myVotes&todo=showVote&voteAction=sendMailAllRemainingVoters&voteId='.$survey->surveyid;
$sendRemainingMessage = 'envoyer';
$sendResultsLink = 'index.php?page=myVotes&todo=showVote&voteAction=sendResults&voteId='.$survey->surveyid;
$sendResultsMessage = 'envoyer';

echo <<<chaineFin
<div class="jumbotron">
        <h3 class="display-4">Vote : $myName</h3>
        <p class="lead">Statut du vote : $myStatus  (<a href=$actionLink>$actionMessage</a>) </p>
        <hr class="my-4">
        <p>Type de vote : $myType </p>
        <p>Nombre de votes déjà effectués : $nbResults/$nbVoters = $proportion %</p>
        <p>Envoyer une invitation à tous les votants : <a href=$sendAllLink>$sendAllMessage</a> (attention, il est conseillé d'avoir activé le vote avant)</p>
        <p>Envoyer une invitation à tous ceux qui n'ont pas voté : <a href=$sendRemainingLink>$sendRemainingMessage</a> (attention, il est conseillé d'avoir activé le vote avant)</p>
        <p>Envoyer les résultats à tout le monde : <a href=$sendResultsLink>$sendResultsMessage</a></p>
</div>
chaineFin;