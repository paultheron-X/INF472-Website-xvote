<script src='home/js/sortableVote.js'></script>
<script src='home/js/jquery-ui.js'></script>

<p><em>Remarque importante :</em> le vote auquel vous vous apprétez à participer est un vote selon la <em>méthode de Borda</em>. Vous devez donc classer tous les candidats, par ordre de préférence (votre candidat préféré le plus hat, etc.).</p>
<p>Afin de pouvoir voter correctement, vous devez impérativement <em>activer JavaScript </em>sur votre navigateur, et glisser les canidats de haut en bas pour les ordonner.</p>

<p><em>Autre remarque :</em> si vous ne connaissez pas le fonctionnement de la méthode de Borda, nous vous conseillons d'en apprendre davantage <a href='index.php?page=electoral-types'>ici</a></p>
<p>Ne vous inquiétez pas, tant que vous n'avez pas validé votre vote, le lien que nous vous avons envoyé reste valide.</p>

<p><em>Candidats disponibles :</em></p>

<?php
echo "<form action='index.php?page=vote&voteAction=submitVote&voteId=$surveyid&voterId=$voterId&key=$key' method='post'  id='frmExample' class='monSortable'>";
echo "<ul id='sortable'>";

$options = $survey->options;
$tableau = explode("&#&", $options);
foreach ($tableau as $index => $value) {
  if ($index > 0) {
    echo "<li id='$value' class='ui-state-default'>$value</li>";
  }
}

echo "</ul>";
?>
<input type="hidden" name="position" id="position" />
