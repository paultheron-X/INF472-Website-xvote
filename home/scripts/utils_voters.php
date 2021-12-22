<?php


class voters {
    // Attributs
    public $voterid;
    public $votermail;
    public $link;
    public $surveyid;


    // Méthodes statiques
    public static function insererVoter($dbh,$votermail,$link,$surveyid) {
        $sth = $dbh->prepare("INSERT INTO `voters` (`votermail`, `link`, `surveyid`) VALUES(?,?,?)");
        $sth->execute(array($votermail, $link, $surveyid));
        }

    
    public static function getVoter($dbh, $voterid) {
        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `voterid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'voters');
        $sth->execute(array($voterid));
        if ($sth->rowCount() == 1) {
            $voter = $sth->fetch();
            $sth->closeCursor();
            return $voter;
        } else {
            return null;
        }
    }

    public static function changerVoter($dbh,$voterid,$votermail,$link,$surveyid) {
        $sth = $dbh->prepare("UPDATE `voters` SET `votermail`=?, `link`=?, `surveyid`=? WHERE `voterid`=?");
        $sth->execute(array($votermail,$link,$surveyid,$voterid));
    }

    public static function delVoter($dbh, $voterid) {
        $sth = $dbh->prepare("DELETE FROM `voters` WHERE `voterid`=?");
        $sth->execute(array($voterid));
    }

    public static function delAllVoters($dbh,$surveyid) {
        $sth = $dbh->prepare("DELETE FROM `voters` WHERE `surveyid`=?");
        $sth->execute(array($surveyid));
    }

    public static function getLastVoterid($dbh, $surveyid) {
        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `surveyid` = ? ORDER BY `voterid` DESC");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'voters');
        $sth->execute(array($surveyid));
        // On est certain qu'il y a au moins un élément, car au moment de l'appel on vient d'en ajouter un
        $voter = $sth->fetch();
        return $voter->voterid;
    }

    public static function getNbVoters($dbh, $surveyid) {
        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `surveyid` = ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($surveyid));
        return ($sth->rowCount());
    }

    public static function checkId($dbh, $voterid, $surveyid) {
        $myvoter = voters::getVoter($dbh, $voterid);
        return ($myvoter != null && get_class($myvoter)=='voters' && $myvoter->surveyid == $surveyid);
    }

    public static function checkmdp($dbh, $voterid, $surveyid, $votermdp) {
        return ($votermdp == sha1((encryption::votersKey()).$voterid.$surveyid));
    }

    public static function ajoutAutomatiqueVoter($dbh,$votermail,$surveyid) {
        // On vérifie d'abord qu'il n'y a pas de voter déjà présent avec le même mail sur le même vote
        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `surveyid`= ? AND `votermail`=?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($surveyid,$votermail));

        if ($sth->rowCount() == 0) {
            // On est obligé de faire plusieurs requêtes pour obtenir le voterId... 
            $sth = $dbh->prepare("INSERT INTO `voters` (`votermail`, `link`, `surveyid`) VALUES(?,?,?)");
            $sth->execute(array($votermail, "", $surveyid));
            
            $voterid = voters::getLastVoterid($dbh, $surveyid);
            $votermdp = sha1((encryption::votersKey()).$voterid.$surveyid);
            $domain = encryption::domain();
            $link = $domain.'/index.php?page=vote&voteId='.$surveyid.'&voterId='.$voterid.'&key='.$votermdp ;
    
            voters::changerVoter($dbh,$voterid,$votermail,$link,$surveyid);
        }

    }

} 
?>