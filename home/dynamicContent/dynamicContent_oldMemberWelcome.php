<div class="jumbotron" data-aos="zoom-in" data-aos-duration="500">
        <h3 class="display-4">Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom'])?> !</h3>
        <p class="lead">Heureux de vous revoir parmis nous !</p>
    </div>


<?php sessionOK($dbh);
