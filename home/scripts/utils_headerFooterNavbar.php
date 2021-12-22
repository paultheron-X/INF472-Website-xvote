<?php

function echoHeader($myTitle, $myCssPath) {
    echo <<<endHeader
<!DOCTYPE html>
<html lang='fr'>
<head>
    <title>$myTitle</title>
    <meta charset='utf-8'>
    <link rel='shortcut icon' href='home/data/favicon.ico'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- CSS et scripts de debut de page -->
    <link href='home/css/bootstrap.min.css' rel='stylesheet'>
    <script src='home/js/jquery.min.js'></script>
    <script src='home/js/popper.min.js'></script>
    <script src='home/js/rollingText.js'></script>
    <script src='home/js/bootstrap.min.js'></script>
    <script src='home/js/app.js'></script>
    <link rel="stylesheet" type="text/css" href="home/css/default_blue.css" />
    <script type="text/javascript" src="home/js/jsSimpleDatePickr.2.1.js"></script>
    <link href="home/css/aos.css" rel="stylesheet">
    <link href='$myCssPath' rel='stylesheet'>
    <link href="home/css/hover.css" rel="stylesheet">
</head>
<body>

endHeader;
}


function echoFooter() {
    echo <<<endFooter
    <!-- Scripts de fin-->
    <script src="home/js/gsap.min.js"></script>
    <script src="home/js/particles.min.js"></script>
    <script src="home/js/aos.js"></script>
  <script>
    AOS.init();
  </script>
    </body>
</html>
endFooter;
}


function echoNavbar($activeItem,$askedPage,$loggedIn) {
    $Items = array(
        '',
        '',
        '',
    );
    $Items[$activeItem]=' active';

    echo <<<endNavbar
    
        <nav class='navbar sticky-top  navbar-expand-lg themeColorBackgroung' >
            <a class='navbar-brand themeColorContentLink' href='index.php?page=welcome'>XVote</a>
            <button class='navbar-toggler custom-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav mr-auto'>
                    <li class='nav-item $Items[0]'>
                        <a class='nav-link themeColorContentLink hvr-underline-from-center' href='index.php?page=welcome'>Accueil <span class='sr-only'>(current)</span></a>
                    </li>

                    <li class='nav-item dropdown $Items[1]'>
                        <a class='nav-link themeColorContentLink hvr-underline-from-center' href='index.php?page=electoral-types'>
                            Types de scrutins
                        </a>
                    </li>

                    <li class='nav-item dropdown $Items[2]'>
                        <a class='nav-link dropdown-toggle themeColorContentLink hvr-underline-from-center' href='index.php?page=accountManagement' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Mon compte XVote
                        </a>
                        <div class='dropdown-menu themeColorBackgroung' aria-labelledby='navbarDropdown'>
                            <a class='dropdown-item themeColorContentLink' href='index.php?page=account'>Connexion & inscription</a>
                            <a class='dropdown-item themeColorContentLink' href='index.php?page=accountManagement'>Gérer mon compte</a>
                            <a class='dropdown-item themeColorContentLink' href='index.php?page=myVotes'>Mes votes</a>
                        </div>
                    </li>
                </ul>
endNavbar;

    if ($loggedIn) {
        $name = htmlspecialchars($_SESSION['prenom']);
        echo <<<endLogOut
                    <form class='form-inline' action="index.php?page=$askedPage&todo=logout" method="post">
                        <div class='input-group'>
                        <span class="input-group-text" id="basic-addon1">Bienvenue, $name !</span>i
                        <input type='submit' class='btn themeColorBackgroung themeColorContentLink' value='Déconnexion'>
                        </div>
                    </form>

                </div>
            </nav>
            <script type="text/javascript" src="home/js/scripts.js"></script>
            <div id="progress"></div>
endLogOut;
        
    }
    else {
        if (isset($_SESSION['wrongPwd']) && $_SESSION['wrongPwd']) {
            $submitMessage = "Réessayer";
        }
        else {
            $submitMessage = "Connexion";
        }
        echo <<<endLogIn
                    <form class='form-inline' action="index.php?page=$askedPage&todo=login" method="post">
                        <div class='input-group'>
                        <input type='text' class='form-control themeColorBackgroung text-black' placeholder='login' aria-label='Username' name='login' required>
                        <input type='password' class='form-control themeColorBackgroung text-black' placeholder='Password' aria-label='Password' name='pwd' required>
                        <input type='submit' class='btn themeColorBackgroung themeColorContentLink' value=$submitMessage>
                        <a class='btn themeColorContentLink' href='index.php?page=account#registerForm'>Inscription</a>
                        </div>
                    </form>
                
                </div>
            </nav>
            <script type="text/javascript" src="home/js/scripts.js"></script>
            <div id="progress"></div>
endLogIn;
    }
}

?>