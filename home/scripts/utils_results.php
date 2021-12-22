<?php
class results {
    // Attributs
    public $resultid;
    public $voterid;
    public $result;
    public $surveyid;
    
    // Méthodes statiques
    public static function insererResult($dbh,$voterid,$result,$surveyid) {
        $sth = $dbh->prepare("INSERT INTO `results` (`voterid`, `result`, `surveyid`) VALUES(?,?,?)");
        $sth->execute(array($voterid, $result, $surveyid));
        }


    public static function getResult($dbh, $resultid) {
        $sth = $dbh->prepare("SELECT * FROM `results` WHERE `resultid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($resultid));
        if ($sth->rowCount() == 1) {
            $result = $sth->fetch();
            $sth->closeCursor();
            return $result;
        } else {
            return null;
        }
    }

    public static function hasVoted($dbh, $voterid) {
        $sth = $dbh->prepare("SELECT * FROM `results` WHERE `voterid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($voterid));
        if ($sth->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function getNbResults($dbh,$surveyid) {
        $sth = $dbh->prepare("SELECT * FROM `results` WHERE `surveyid` = ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($surveyid));
        return ($sth->rowCount());
    }

    public static function getResultsSondageUninomial($dbh, $surveyid) {
        $sth = $dbh->prepare("SELECT * FROM `results` WHERE `surveyid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($surveyid));
        $resultTab = $sth->fetch();
        $options = survey::getOptions($dbh,$surveyid);
        $compteur = array();
        foreach ($options as $value) {
            if ($value != "") {
                $compteur[$value] = 0;
            }
        }
        unset($value);
        while ($resultTab != null) {
            if (isset($compteur[$resultTab->result])){
                $compteur[$resultTab->result] = $compteur[$resultTab->result] + 1;
            }
            $resultTab = $sth->fetch();     
        }
        $sth->closeCursor();
        return $compteur;
    }


    public static function getResultsSondageBorda($dbh, $surveyid) {
        $sth = $dbh->prepare("SELECT * FROM `results` WHERE `surveyid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'results');
        $sth->execute(array($surveyid));
        $resultTab = $sth->fetch();
        $options = survey::getOptions($dbh,$surveyid);
        $compteur = array();
        foreach ($options as $value) {
            if ($value != "") {
                $compteur[$value] = 0;
            }
        }
        unset($value);
        $n = count($compteur);
        while ($resultTab != null) {
            $resultat = explode("&#&", $resultTab->result);
            $k = 0;
            foreach ($resultat as $value) {
                if (isset($compteur[$value])){
                    $compteur[$value] = $compteur[$value] + $n - $k ;
                    $k = $k + 1;
                }
            }
            $resultTab = $sth->fetch();     
        }
        $sth->closeCursor();
        return $compteur;
    }
}