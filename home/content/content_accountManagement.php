<?php
    if ($_SESSION['loggedIn']) {
        echo "<div class='container'>";
        require('home/dynamicContent/dynamicContent_changeDetails.php');
        require('home/dynamicContent/dynamicContent_signOut.php');
        echo "</div>";
    } else {
        require('home/content/content_account.php');
    }
