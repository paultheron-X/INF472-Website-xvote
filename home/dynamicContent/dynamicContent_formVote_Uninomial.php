<?php
echo "<form action='index.php?page=vote&voteAction=submitVote&voteId=$surveyid&voterId=$voterId&key=$key' method='post'>";


$options = $survey->options;
$tableau = explode("&#&", $options);
foreach ($tableau as $index => $value) {
  if ($index > 0) {
    echo "<div class='form-check'>
    <input class='form-check-input' type='radio' name='vote' value='$value'>
    <label class='form-check-label' for='$value'>
    $value
    </label>
    </div>";
  }
}

?>