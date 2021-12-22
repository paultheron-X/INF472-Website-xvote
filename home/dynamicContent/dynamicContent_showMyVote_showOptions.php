<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-black themeColorBackgroung themeColorContent">
            <h3>Mes options de vote</h3>
        </div>
        <div class="card-body">
            <?php $actionLinkAddOption = "index.php?page=myVotes&todo=showVote&voteAction=addOption&voteId=".$_SESSION['surveyid']; ?>
            <p>Vous pouvez ajouter ici les différentes options (par exemple, les différent(e)s candidat(e)s de votre élection) de votre vote.</p>
            <p><em>Remarque importante :</em> vous êtes limités à 39 options différentes, et vous ne pouvez pas mettre deux fois une même option.</p>
            <form action= "<?php echo $actionLinkAddOption; ?>" method="post">
                <table class="table">
                    <thead class="thead-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom de l'option</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($survey->options != "") {
                            $myoptions = explode('&#&',$survey->options);
                        }
                        else {
                            $myoptions = explode('&#&',"&#&##### Pas d'options de vote pour l'instant ! #####");
                        }


                        foreach($myoptions as $index => $value) {
                            if ($index > 0) { // Il y a toujours une ligne 0 vide
                                $printableValue = htmlspecialchars($value);
                                $deleteLink= "index.php?page=myVotes&todo=showVote&voteAction=delOption&voteId=".$_SESSION['surveyid']."&option=".$printableValue;

                                echo  <<<chaineFin
                                <tr>
                                    <th>$index</th>
                                    <td>$printableValue</td>
                                    <td><a href="$deleteLink">Supprimer</a></td>
                                </tr>
                            chaineFin;
                            }
                        }
                        ?>

                        <tr>
                            <th></th>
                            <td><input type="text" placeholder="Nom de l'option" name="newOption" required /></td>
                            <td><input type='submit' value="Ajouter une option" ></td>
                        </tr>
                        
                    </tbody>

                </table>
            </form>

        </div>
</div>