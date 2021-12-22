<?php
class survey
{
    //Atributs
    public $surveyid;
    public $type;
    public $login;
    public $enddate;
    public $surveyname;
    public $description;
    public $status;
    public $options;

    //fonctions
    public static function insererSurvey($dbh, $type, $login, $enddate, $surveyname, $description, $status, $options) {
        $sth = $dbh->prepare("INSERT INTO `survey` (`type`, `login`, `enddate`, `surveyname`, `description`, `status`, `options`) VALUES(?,?,?,?,?,?,?)");
        $sth->execute(array($type, $login, $enddate, $surveyname, $description, $status, $options));
    }


    public static function getSurvey($dbh, $surveyid) {
        $sth = $dbh->prepare("SELECT * FROM `survey` WHERE `surveyid`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'survey');
        $sth->execute(array($surveyid));
        if ($sth->rowCount() == 1) {
            $survey = $sth->fetch();
            $sth->closeCursor();
            return $survey;
        } else {
            return null;
        }
    }

    public static function changerSurvey($dbh,$surveyid,$enddate,$surveyname,$description,$status, $options) {
        $sth = $dbh->prepare("UPDATE `survey` SET `enddate`=?, `surveyname`=?, `description`=?, `status`=?, `options`= ? WHERE `surveyid`=?");
        $sth->execute(array($enddate,$surveyname,$description,$status,$options,$surveyid));
    }


    public static function getLastSurveyid($dbh, $login) {
        $sth = $dbh->prepare("SELECT * FROM `survey` WHERE `login` = ? ORDER BY `surveyid` DESC");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'survey');
        $sth->execute(array($login));
        // On est certain qu'il y a au moins un élément, car au moment de l'appel on vient d'en ajouter un
        $survey = $sth->fetch();
        return $survey->surveyid;
    }

    public static function checkLogin($dbh, $surveyid, $userlogin) {
        $mysurvey = survey::getSurvey($dbh, $surveyid);
        return ($mysurvey != null && get_class($mysurvey)=='survey' && $mysurvey->login == $userlogin);
    }

    public static function startVote($dbh, $surveyid) {
        $mysurvey = survey::getSurvey($dbh, $surveyid);
        if ( $mysurvey != null and get_class($mysurvey) == 'survey' ){
            survey::changerSurvey($dbh,$surveyid,$mysurvey->enddate,$mysurvey->surveyname,$mysurvey->description,1, $mysurvey->options);
        }
    }

    public static function stopVote($dbh, $surveyid) {
        $mysurvey = survey::getSurvey($dbh, $surveyid);
        if ( $mysurvey != null and get_class($mysurvey) == 'survey' ){
            survey::changerSurvey($dbh,$surveyid,$mysurvey->enddate,$mysurvey->surveyname,$mysurvey->description,2,$mysurvey->options);
        }
    }

    public static function isAvailableToVote($dbh,$surveyid) {
        $mysurvey = survey::getSurvey($dbh, $surveyid);
        return ($mysurvey->status == 1);
    }

    public static function delVote($dbh, $surveyid) {
        $sth = $dbh->prepare("DELETE FROM `survey` WHERE `surveyid`=?");
        $sth->execute(array($surveyid));
    }

    public static function addOption($dbh, $surveyid, $newOption) {
        $survey = survey::getSurvey($dbh, $surveyid);
        if (count(explode('&#&',$survey->options)) -1 < 39 && strpos($survey->options,$newOption) == false) {
            $myNewOptions = ($survey->options)."&#&".$newOption;
            survey::changerSurvey($dbh,$surveyid,$survey->enddate,$survey->surveyname,$survey->description,$survey->status, $myNewOptions);
        }
    }

    public static function getOptions($dbh,$surveyid) {
        $survey = survey::getSurvey($dbh, $surveyid);
        return explode("&#&", $survey->options);
    }

    public static function delOption($dbh,$surveyid,$myOption) {
        $survey = survey::getSurvey($dbh, $surveyid);
        $options = explode("&#&",$survey->options);
        foreach($options as $key => $value) {
            if ($value == $myOption) {
                unset($options[$key]);
            }
        }
        survey::changerSurvey($dbh,$surveyid,$survey->enddate,$survey->surveyname,$survey->description,$survey->status, implode('&#&', $options));

    }
}
