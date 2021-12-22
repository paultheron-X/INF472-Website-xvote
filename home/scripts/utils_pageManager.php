<?php
///////////////////////////////////////
////////////// PAGE LIST //////////////
///////////////////////////////////////
$page_list = array(
    array(
        "name"=>"welcome",
        "title"=>"XVote",
        "menutitle"=>0),
    array(
        "name"=>"electoral-types",
        "title"=>"Types de scrutins",
        "menutitle"=>1),
    array(
        "name"=>"account",
        "title"=>"Mon espace XVote",
        "menutitle"=>2),
    array(
        "name"=>"accountManagement",
        "title"=>"Gérer mon compte XVote",
        "menutitle"=>2),
    array(
        "name"=>"myVotes",
        "title"=>"Mes votes",
        "menutitle"=>2),
    array(
        "name"=>"vote",
        "title"=>"Voter !",
        "menutitle"=>2),
    array(
        "name"=>"voteFinished",
        "title"=>"Le vote est terminé...",
        "menutitle"=>2),
    array(
        "name"=>"vote",
        "title"=>"Voter !",
        "menutitle"=>2),
    array(
        "name"=>"showResults",
        "title"=>"Résultats !",
        "menutitle"=>2),
    array(
        "name"=>"workPage1",
        "title"=>"Page de travail 1",
        "menutitle"=>0),
    array(
        "name"=>"workPage2",
        "title"=>"Page de travail 2",
        "menutitle"=>0),
    
);




///////////////////////////////////////
//////////////// UTILS ////////////////
///////////////////////////////////////
function checkPage($askedPage) {
    global $page_list;
    foreach($page_list as $page){
        if($page['name'] == $askedPage) {
            return TRUE;
        }
    }
    return FALSE;
};

function getPageTitle($askedPage) {
    global $page_list;
    foreach($page_list as $page){
        if($page['name'] == $askedPage) {
            return $page['title'];
        }
    }
    return 'welcome';
}

function getPageMenuTitle($askedPage) {
    global $page_list;
    foreach($page_list as $page){
        if($page['name'] == $askedPage) {
            return $page['menutitle'];
        }
    }
    return 0;
}
?>