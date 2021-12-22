<div class='container'>

<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
    <div class="card-header text-black themeColorBackgroung themeColorContent">
    <h3>Participer au vote "<?php echo(htmlspecialchars($survey->surveyname)); ?>" !</h3>
  </div>
<div class="card-body">

<?php
// Variables qui seront nécessaires à la fois pour Uninomial et pour Borda
$surveyid = $survey->surveyid;
$voterId = $voter->voterid;
$key = $_GET['key'];

if ($survey->type == 'Scrutin uninomial') {
  require('home/dynamicContent/dynamicContent_formVote_Uninomial.php');
}

elseif ($survey->type == 'Méthode de Borda') {
  require('home/dynamicContent/dynamicContent_formVote_Borda.php');
}

?>


<input type='submit' id="btnSubmitVote" value="Voter !" >
</form>
</div>

