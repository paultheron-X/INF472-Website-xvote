<?php

class sendMails {

    public static function subject($surveyname) {
        return  ('Invitation à voter - '.$surveyname);
    }
    
    public static function bodyHtml($surveyname,$description,$enddate,$link,$type) {
        return <<<chaineFin
        <div style='background-color:#194D6F;text-align:center;'>
        <h3 style='color:#F69202'>XVote</h3>
        </div>
        <p><em style='color:#F69202'>Madame, Monsieur,</em></p>
        <p>Vous êtes invités à participer à un vote en ligne sur le site internet <a href='https://www.************.com/xvote'>xvote</a></p>
        
        <p>Voici quelques détails que vous devez connaître avant de voter :</p>
        <ul>
            <li>Nom du vote : $surveyname </li>
            <li>Type de scrutin : $type </li>
            <li>Description : $description</li>
            <li>Date de fin : $enddate</li>
        </ul> 
        
        <p>Pour voter, vous n'éavez pas besoin de créer de compte ; il vous suffit de cliquer sur le lien suivant à usage unique :</p>
        <ul style = "list-style-type:none;">
            <li><a href=$link>$link</a></li>
        </ul>

        <p>Pour obtenir plus d'informations sur le fonctionnement de nos différents types de scrutins, vous pouvez vous rendre directement sur notre <a href='https://wwww.************.com/xvote/index.php?page=electoral-types'>site internet</a></p>
        
        <p>Au nom de toute l'équipe XVote, nous vous souhaitons une bonne journée,</p>
        <p>Cordialement,</p>
        <p></p>
        <p><em style='color:#F69202'>Jérémie et Paul pour l'équipe XVote</em></p>
        <div style='background-color:#194D6F;text-align:center;'>
        <p><a href='https://www.************.com/xvote' style='color:#F69202'>www.************.com/xvote</a></p>
        </div>
        
    chaineFin;
    }

    public static function bodyText($surveyname,$description,$enddate,$link,$type) {
        return <<<chaineFin
Madame, Monsieur,
Vous êtes invités à participer à un vote en ligne sur le site internet https://www.************.com/xvote'

Voici quelques détails que vous devez connaître avant de voter :
    -Nom du vote : $surveyname
    -Type de scrutin : $type
    -Description : $description
    -Date de fin : $enddate

Pour voter, vous n'éavez pas besoin de créer de compte ; il vous suffit de cliquer sur le lien suivant à usage unique :</p>
    $link

    Pour obtenir plus d'informations sur le fonctionnement de nos différents types de scrutins, vous pouvez vous rendre directement sur notre site : https://www.************.com/xvote/index.php?page=electoral-types

Au nom de toute l'équipe XVote, nous vous souhaitons une bonne journée,
Cordialement,

Jérémie et Paul pour l'équipe XVote
chaineFin;
    }


    public static function sendMailAllVoters($dbh,$surveyid) {
        $survey = survey::getSurvey($dbh,$surveyid);

        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `surveyid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'voters');
        $sth->execute(array($surveyid));
        
        $voter=$sth->fetch();
        while ($voter != null) {
            sendMail($voter->votermail,sendMails::subject($survey->surveyname),sendMails::bodyHtml($survey->surveyname,$survey->description,$survey->enddate,$voter->link,$survey->type),sendMails::bodyText($survey->surveyname,$survey->description,$survey->enddate,$voter->link,$survey->type));

            $voter=$sth->fetch();
        }
    }

    public static function sendMailAllRemainingVoters($dbh,$surveyid) {
        $survey = survey::getSurvey($dbh,$surveyid);

        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `surveyid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'voters');
        $sth->execute(array($surveyid));
        
        $voter=$sth->fetch();
        while ($voter != null) {
            if (! results::hasVoted($dbh,$voter->voterid)) {
                sendMail($voter->votermail,sendMails::subject($survey->surveyname),sendMails::bodyHtml($survey->surveyname,$survey->description,$survey->enddate,$voter->link,$survey->type),sendMails::bodyText($survey->surveyname,$survey->description,$survey->enddate,$voter->link,$survey->type));
            }

            $voter=$sth->fetch();
        }
    }


}