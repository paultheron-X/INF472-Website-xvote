<?php
///////////////////////////////////////
////////////// SESSIONS ///////////////
///////////////////////////////////////
session_name("XVoteSession");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = TRUE;
}
if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = FALSE;
}






///////////////////////////////////////
//////////////// UTILS ////////////////
///////////////////////////////////////
require('home/scripts/utils_changeDetails.php');
require('home/scripts/utils_checkDate.php');
require('home/scripts/utils_database.php');
require('home/scripts/utils_encryption.php');
require('home/scripts/utils_headerFooterNavbar.php');
require('home/scripts/utils_logInLogOut.php');
require('home/scripts/utils_mailManager.php');
require('home/scripts/utils_newSurvey.php');
require('home/scripts/utils_pageManager.php');
require('home/scripts/utils_register.php');
require('home/scripts/utils_results.php');
require('home/scripts/utils_sendMails.php');
require('home/scripts/utils_sessionManager.php');
require('home/scripts/utils_signOut.php');
require('home/scripts/utils_submitVote.php');
require('home/scripts/utils_survey.php');
require('home/scripts/utils_uploadCSV.php');
require('home/scripts/utils_utilisateur.php');
require('home/scripts/utils_voters.php');







///////////////////////////////////////
////////////// DATA BASE //////////////
///////////////////////////////////////
$dbh = Database::connect();






///////////////////////////////////////
////////////// GET PAGE ///////////////
///////////////////////////////////////
if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = 'welcome';
}

$authorized = checkPage($askedPage);

if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $askedPage = 'unfound';
    $pageTitle = 'Error';
}





///////////////////////////////////////
//////////////// TODO /////////////////
///////////////////////////////////////
if (isset($_GET['todo'])) {
    switch ($_GET['todo']) {
        case 'login':
            if (isset($_POST['login']) && $_POST['login'] != "" && isset($_POST['pwd']) && $_POST['pwd'] != "") {
                logIn($dbh);
            } else {
                logOut();
            }
            break;



        case 'logout':
            logOut();
            break;



        case 'register':
            if (register($dbh)) {
                $_SESSION['newMember'] = TRUE;
            } else {
                $_SESSION['newMember'] = FALSE;
            }
            break;



        case 'changeDetails':
            if (changeDetails($dbh)) {
                $_SESSION['detailsChanged'] = TRUE;
            } else {
                $_SESSION['detailsChanged'] = FALSE;
            }
            break;



        case 'signOut':
            if (signOut($dbh)) {
                $_SESSION['signedOut'] = TRUE;
                logOut();
                $askedPage = 'signedOut';
            } else {
                $_SESSION['signedOut'] = FALSE;
            }
            break;



        case 'newSurvey':
            if (newSurvey($dbh)) {
                $_SESSION['newSurveyCreated'] = TRUE;
            } else {
                $_SESSION['newSurveyCreated'] = FALSE;
            }
            break;

        

        case 'testMail':
            sendMail('jeremie.dentan@live.com','Here is the subject','This is the HTML message body <b>in bold!</b>','This is the body in plain text for non-HTML mail clients');

    }
}
// Cas du todo=showVote : cf la partie PAGE AUTHORIZATIONS un peu plus bas




///////////////////////////////////////
///////////// VOTE ACTION /////////////
///////////////////////////////////////


if (isset($_GET['voteAction'])) {
    switch ($_GET['voteAction']) {
        case 'startVote':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
                    survey::startVote($dbh, $_GET['voteId']);
                } else {
                    $askedPage = 'unfound';
                }
            } else {
                $askedPage = 'unfound';
            }
            break;



        case 'stopVote':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
                    survey::stopVote($dbh, $_GET['voteId']);
                } else {
                    $askedPage = 'unfound';
                }
            } else {
                $askedPage = 'unfound';
            }
            break;



        case 'delVote':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
                    survey::delVote($dbh, $_GET['voteId']);
                } else {
                    $askedPage = 'unfound';
                }
            } else {
                $askedPage = 'unfound';
            }
            break;



        case 'addOption':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
                    survey::addOption($dbh, $_GET['voteId'], $_POST["newOption"]);
                } else {
                    $askedPage = 'unfound';
                    sessionOK($dbh);
                }
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;



        case 'delOption':
            if (
                isset($_GET['voteId']) && $_GET['voteId'] != '' &&
                survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login']) &&
                isset($_GET['option']) && $_GET['option'] != ''
            ) {
                survey::delOption($dbh, $_GET['voteId'], $_GET['option']);
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;



        case 'addVoter':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login']) &&
                    filter_var($_POST['newVoterMail'], FILTER_VALIDATE_EMAIL)
                ) {
                    voters::ajoutAutomatiqueVoter($dbh, $_POST['newVoterMail'], $_GET["voteId"]);
                } else {
                    $askedPage = 'unfound';
                    sessionOK($dbh);
                }
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;
        


        case 'addCSV':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '' &&
                isset($_FILES['fichier']['tmp_name']) && $_FILES['fichier']['tmp_name'] != ''
            ) {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login']) &&
                    uploadCSV::checkSize($_FILES['fichier']['tmp_name'])
                ) {
                    uploadCSV::pushToDB($dbh,$_FILES['fichier']['tmp_name'],$_GET['voteId']);
                }
                else {
                    $askedPage = 'unfound';
                    sessionOK($dbh);
                }
            }
            else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;
            


        case 'delVoter':
            if (
                isset($_GET['voteId']) && $_GET['voteId'] != '' &&
                survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login']) &&
                isset($_GET['voterId']) && $_GET['voterId'] != '' &&
                voters::checkId($dbh, $_GET['voterId'], $_GET['voteId'])
            ) {
                voters::delVoter($dbh, $_GET['voterId']);
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;



        case 'delAllVoter':
            if (
                isset($_GET['voteId']) && $_GET['voteId'] != '' &&
                survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])
            ) {
                voters::delAllVoters($dbh, $_GET['voteId']);
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;



        case 'submitVote':
            if (
                isset($_GET['voteId']) && $_GET['voteId'] != '' &&
                isset($_GET['voterId']) && $_GET['voterId'] != '' &&
                isset($_GET['key']) && $_GET['key'] != '' &&
                voters::checkId($dbh, $_GET['voterId'], $_GET['voteId']) &&
                voters::checkmdp($dbh, $_GET['voterId'], $_GET['voteId'], $_GET['key'])
            ) {
                if (! results::hasVoted($dbh, $_GET['voterId']) &&
                    survey::isAvailableToVote($dbh,$_GET['voteId']))
                {
                    insererVote($dbh, $_GET['voteId'], $_GET['voterId']);
                }
            } else {
                $askedPage = 'unfound';
            }
            break;
        
        
        
        case 'sendMailAllVoters':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
                    sendMails::sendMailAllVoters($dbh,$_GET['voteId']);
                } else {
                    $askedPage = 'unfound';
                    sessionOK($dbh);
                }
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;



        case 'sendMailAllRemainingVoters':
            if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
                if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
                    sendMails::sendMailAllRemainingVoters($dbh,$_GET['voteId']);
                } else {
                    $askedPage = 'unfound';
                    sessionOK($dbh);
                }
            } else {
                $askedPage = 'unfound';
                sessionOK($dbh);
            }
            break;


        default:
            $askedPage = 'unfound';
    }
}








///////////////////////////////////////
///////// PAGE AUTHORIZATIONS /////////
///////////////////////////////////////

// Autorisation pour le formulaire de vote
if ($askedPage == 'vote') {
    if (!(
        isset($_GET['voteId']) && $_GET['voteId'] != '' &&
        isset($_GET['voterId']) && $_GET['voterId'] != '' &&
        isset($_GET['key']) && $_GET['key'] != '' &&
        voters::checkId($dbh, $_GET['voterId'], $_GET['voteId']) &&
        voters::checkmdp($dbh, $_GET['voterId'], $_GET['voteId'], $_GET['key'])
        )
    ) {
        $askedPage = 'unfound';
    }
}


// Autorisation pour afficher les détails du vote et les résultats
// On est obligé de mettre ce cas à part parce qu'il faut faire $_SESSION['showVoteAuthorized'] = FALSE; si c'est faux
if (isset($_GET['todo']) && $_GET['todo'] == 'showVote') {
    if (isset($_GET['voteId']) && $_GET['voteId'] != '') {
        if (survey::checkLogin($dbh, $_GET['voteId'], $_SESSION['login'])) {
            $_SESSION['surveyid'] = $_GET['voteId'];
            $_SESSION['showVoteAuthorized'] = TRUE;
        } else {
            $askedPage = 'unfound';
            sessionOK($dbh);
        }
    } else {
        $askedPage = 'unfound';
        sessionOK($dbh);
    }
} else {
    $_SESSION['showVoteAuthorized'] = FALSE;
}

// Autorisation pour afficher les résultats du vote
if ($askedPage=='showResults') {
    if (!(
        isset($_GET['voteId']) && $_GET['voteId'] != null &&
        isset($_GET['key']) && $_GET['key'] != null &&
        $_GET['key'] == sha1($_GET['voteId'].encryption::votersKey())
        )
    ) {
            $askedPage = 'unfound';
    }
}








///////////////////////////////////////
/////////////// CONTENT ///////////////
///////////////////////////////////////
echoHeader($pageTitle, 'home/css/perso.css');
echoNavbar(getPageMenuTitle($askedPage), $askedPage, $_SESSION["loggedIn"]);






if ($authorized) {
    require('home/content/content_' . $askedPage . '.php');
} else {
    require('home/content/content_unfound.php');
}
// Debugging
// var_dump($_SESSION);
// echo "</br>";
// var_dump($_POST);

echoFooter();








///////////////////////////////////////
////////////// DATA BASE //////////////
///////////////////////////////////////
$dbh = null;
