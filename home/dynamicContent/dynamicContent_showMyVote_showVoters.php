<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-black themeColorBackgroung themeColorContent">
            <h3>Mes participants</h3>
        </div>
        <div class="card-body">
            <?php   $actionLinkAddVoter = "index.php?page=myVotes&todo=showVote&voteAction=addVoter&voteId=".$_SESSION['surveyid']; 
                    $actionLinkAddCSV = "index.php?page=myVotes&todo=showVote&voteAction=addCSV&voteId=".$_SESSION['surveyid']; 
                    $actionLinkDeleteAll = "index.php?page=myVotes&todo=showVote&voteAction=delAllVoter&voteId=".$_SESSION['surveyid']; ?>
                <p>Vous trouverez ici la liste des votants, et vous pouvez ajouter à la main des votants.</p>
                <p>Vous pouvez également ajouter jusqu'à 10.000 votants d'un coup grâce à un fichier .csv comportant leurs adresses mails <em>sur une colonne</em>, et <em>sans adresse mail sur la première ligne.</em> </p>
                <p>En cas d'erreur, vous pouvez également supprimer tous les votants en cliquant <a href= <?php echo $actionLinkDeleteAll; ?> >ici</a>.</p>

                <table class="table">
                    <thead class="thead-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Email du votant</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sth = $dbh->prepare("SELECT * FROM `voters` WHERE `surveyid`= ?");
                        $sth->setFetchMode(PDO::FETCH_CLASS, 'voters');
                        $sth->execute(array($survey->surveyid));
                        $i = 1;
                        $voter = $sth->fetch();
                        while ($voter != null) {

                            $printableMail = htmlspecialchars($voter->votermail);
                            $deleteLink= "index.php?page=myVotes&todo=showVote&voteAction=delVoter&voteId=".$_SESSION['surveyid']."&voterId=".$voter->voterid;
                            if (results::hasVoted($dbh,$voter->voterid)){
                                $status = 'A voté';
                            }
                            else {
                                $status = 'Pas voté';
                            }
                            echo  <<<chaineFin
                            <tr>
                                <th>$i</th>
                                <td>$status</td>
                                <td>$printableMail</td>
                                <td><a href="$deleteLink">Supprimer</a></td>
                            </tr>
                        chaineFin;
                        $voter = $sth->fetch();
                        $i++;
                        }
                        ?>

                        <tr>
                            <th></th>
                            <td></td>
                            <form action= "<?php echo $actionLinkAddVoter; ?>" method="post">
                                <td><input type="email" placeholder="Mail du votant" name="newVoterMail" required /></td>
                                <td><input type='submit' value="Ajouter une votant" ></td>
                            </form>
                        </tr>

                        <tr>
                            <th></th>
                            <td></td>
                            <form action= "<?php echo $actionLinkAddCSV; ?>" method="post" enctype="multipart/form-data">
                                <td><input type="file" name="fichier"/></td>
                                <td><input type="submit" value="Charger fichier .csv" /></td>
                            </form>
                        </tr>

                        
                    </tbody>

                </table>
            

        </div>
</div>