<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
    <div class="card-header text-black themeColorBackgroung themeColorContent">
        <h3>Tous mes votes</h3>
    </div>
    <div class="card-body">

        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Description</th>
                    <th scole="col">Action</th>
                    <th scole="col">Lien</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sth = $dbh->prepare("SELECT * FROM `survey` WHERE `login`= ?");
                $sth->setFetchMode(PDO::FETCH_CLASS, 'survey');
                $sth->execute(array($_SESSION['login']));
                $i = 0;
                $survey = $sth->fetch();
                while ($survey != null) {

                    // On met à jour le statut du vote si besoin
                    checkEndDate($dbh, $survey);

                    $mySurveyname = htmlspecialchars($survey->surveyname);
                    $myType = htmlspecialchars($survey->type);
                    $myEnddate = htmlspecialchars($survey->enddate);
                    $myDescription = htmlspecialchars($survey->description);


                    switch ($survey->status) {
                        case 0:
                            $myStatus = 'Inactif';
                            $actionLink = 'index.php?page=myVotes&voteAction=startVote&voteId=' . $survey->surveyid;
                            $actionMessage = 'Démarrer le vote';
                            break;
                        case 1:
                            $myStatus = 'En cours';
                            $actionLink = 'index.php?page=myVotes&voteAction=stopVote&voteId=' . $survey->surveyid;
                            $actionMessage = 'Terminer le vote';
                            break;
                        case 2:
                            $myStatus = 'Terminé';
                            $actionLink = 'index.php?page=myVotes&voteAction=delVote&voteId=' . $survey->surveyid;
                            $actionMessage = 'Supprimer le vote';
                            break;
                    }

                    $resultLink = 'index.php?page=myVotes&todo=showVote&voteId=' . $survey->surveyid;

                    echo  <<<chaineFin
                    <tr>
                        <td>$mySurveyname</td>
                        <td>$myStatus</td>
                        <td>$myType</td>
                        <td>$myEnddate</td>
                        <td>$myDescription</td>
                        <td><a href=$actionLink>$actionMessage</a></td>
                        <td><a href=$resultLink>Détails et résultats</a></td>
                    </tr>
                    chaineFin;

                    $survey = $sth->fetch();
                }
                $sth->closeCursor();
                ?>
            </tbody>
        </table>

    </div>
</div>