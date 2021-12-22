<?php
echo "<div class='container'>";
$survey = survey::getSurvey($dbh,$_GET['voteId']);
require('home/dynamicContent/dynamicContent_showMyVote_ShowResult.php');
echo "</div>";