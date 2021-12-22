<?php // Partage des résulats
    $globalLink = encryption::domain().'/index.php?page=showResults&voteId='.$survey->surveyid.'&key='.sha1($survey->surveyid.encryption::votersKey());
    $localLink = 'index.php?page=showResults&voteId='.$survey->surveyid.'&key='.sha1($survey->surveyid.encryption::votersKey());
    ?>
    <p><em>Partage des résultats :</em> les résultats sont accessible en suivant le lien suivant. Lorsque le vote sera fini, nous vous conseillons d'envoyer un mail à tous les votants afin de leur </em>annoncer les résultats</em>, et en joingnant ce lien afin qu'ils puissent les consulter.</p>
    <p class='getCenter'><a href=<?php echo $localLink;?>><?php echo $globalLink;?></a></p>
    </br>