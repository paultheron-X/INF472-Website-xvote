<div class="jumbotron">
        <h3 class="display-4">Félicitation pour votre inscription, <?php echo htmlspecialchars($_SESSION['prenom'])?> !</h3>
        <p class="lead">Vous avez franchi le premier pas !</p>
    </div>


<?php sessionOK($dbh);