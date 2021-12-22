<?php
    if ($_SESSION['loggedIn']) {

        echo "<div class='container'>";


        if ($_SESSION['showVoteAuthorized']) {
            require('home/dynamicContent/dynamicContent_showMyVote.php');
        } elseif ($_SESSION['newSurveyCreated']) {
            require('home/dynamicContent/dynamicContent_newSurveyCreated.php');
        } else {
            require('home/dynamicContent/dynamicContent_mySurvey.php');
            require('home/dynamicContent/dynamicContent_newSurvey.php');
        }



        echo "</div>";
    } else {
        require('home/content/content_account.php');
    }
