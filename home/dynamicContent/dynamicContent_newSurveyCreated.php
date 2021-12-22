<?php $voteLink = 'index.php?page=myVotes&todo=showVote&voteId='.$_SESSION['surveyid']?>

<div class="jumbotron">
        <h3 class="display-4">Félicitation, <?php echo htmlspecialchars($_SESSION['prenom'])?> !</h3>
        <p class="lead">Votre vote a bien été crée !</p>
        <hr class="my-4">
        <p>Prêt(e) à ajouter des participants et gérer votre vote ? <a href =  <?php echo $voteLink ?>>Allons-y !</a> </p>


    </div>

<?php sessionOK($dbh);