<?php
$survey = survey::getSurvey($dbh, $_SESSION['surveyid']);

require('home/dynamicContent/dynamicContent_showMyVote_showInfos.php');
require('home/dynamicContent/dynamicContent_showMyVote_showWarning.php');
require('home/dynamicContent/dynamicContent_showMyVote_showOptions.php');
require('home/dynamicContent/dynamicContent_showMyVote_showVoters.php');
require('home/dynamicContent/dynamicContent_showMyVote_showResult.php');







