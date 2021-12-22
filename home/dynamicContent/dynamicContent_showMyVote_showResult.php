<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-black themeColorBackgroung themeColorContent">
        <h3>Resultats du vote</h3>
    </div>

    <div class="card-body">

    
    <?php 
    if ($askedPage == 'myVotes') {
        require('home/dynamicContent/dynamicContent_showMyVote_shareResults.php');
    }
    ?>


    <?php //Données de participation
    if ($survey->type == 'Scrutin uninomial'){
        $compteur = results::getResultsSondageUninomial($dbh, $survey->surveyid);
    }
    elseif ($survey->type == 'Méthode de Borda') {
        $compteur = results::getResultsSondageBorda($dbh, $survey->surveyid);
    }
    $myName = htmlspecialchars($survey->surveyname);
    $myType = htmlspecialchars($survey->type);
    $myDescription = htmlspecialchars($survey->description);
    $nbVoters = voters::getNbVoters($dbh,$survey->surveyid);
    $nbResults = results::getNbResults($dbh,$survey->surveyid);
    $nbPointsVote = 0;
    if ($nbVoters == 0){
        $proportion = 0;
    }
    else {
        $proportion = round(100*$nbResults/$nbVoters,2);
    }
    foreach ($compteur as $key=>$value) {
        $nbPointsVote = $nbPointsVote + $value;
    }
    ?>
    <ul>
        <li><em>Nom du vote :</em> <?php echo $myName?></li>
        <li><em>Description :</em> <?php echo $myDescription?></li>
        <li><em>Type de scrutin :</em> <?php echo $myType?></li>
        <li><em>Nombre de votants :</em> <?php echo $nbVoters?></li>
        <li><em>Participation :</em> <?php echo "$nbResults/$nbVoters ($proportion %)"?></li>
        <li><em>Nombre de points de vote :</em> <?php echo "$nbPointsVote (pour le vote par méthode de Borda)"?></li>

    </ul>
    </br>
    </br>


    <div class="row">
            <div class="col-md-4 offset-md-1">
            <script src="home/js/Chart.min.js"></script>
            <canvas id="myChart" width="200" height="200"></canvas>
            <script>
                <?php 
                $php_data = array();
                $i = 0;
                foreach ($compteur as $value) {
                    $php_data[$i] = $value;
                    $i++;
                }
                // On retire les chaines vides causées par le  &#& qui est au debut de chaine de codage de resultats et d options
                $myOptions = survey::getOptions($dbh, $survey->surveyid);
                $k = 0;
                $php_options = array();
                foreach($myOptions as $value) {
                    if ($value != "") {
                        $php_options[$k] = $value;
                        $k = $k + 1;
                    }
                }
                ?>;

                var lab = <?php echo json_encode($php_options); ?>;
                var dat = <?php echo json_encode($php_data); ?>;
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: lab,
                        datasets: [{
                            label: '# of Votes',
                            data: dat,
                            backgroundColor: [
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(119, 130, 255, 0.2)',
                                'rgba(70, 255, 242, 0.2)',
                                'rgba(255, 14, 150, 0.2)',
                                'rgba(209, 255, 60, 0.2)',
                                'rgba(16, 20, 255, 0.2)',
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(119, 130, 255, 0.2)',
                                'rgba(70, 255, 242, 0.2)',
                                'rgba(255, 14, 150, 0.2)',
                                'rgba(209, 255, 60, 0.2)',
                                'rgba(16, 20, 255, 0.2)',
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(119, 130, 255, 0.2)',
                                'rgba(70, 255, 242, 0.2)',
                                'rgba(255, 14, 150, 0.2)',
                                'rgba(209, 255, 60, 0.2)',
                                'rgba(16, 20, 255, 0.2)',
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                            ],
                            borderColor: [
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(119, 130, 255, 1)',
                                'rgba(70, 255, 242, 1)',
                                'rgba(255, 14, 150, 1)',
                                'rgba(209, 255, 60, 1)',
                                'rgba(16, 20, 255, 1)',
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 255, 0, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(119, 130, 255, 1)',
                                'rgba(70, 255, 242, 1)',
                                'rgba(255, 14, 150, 1)',
                                'rgba(209, 255, 60, 1)',
                                'rgba(16, 20, 255, 1)',
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 255, 0, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(119, 130, 255, 1)',
                                'rgba(70, 255, 242, 1)',
                                'rgba(255, 14, 150, 1)',
                                'rgba(209, 255, 60, 1)',
                                'rgba(16, 20, 255, 1)',
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 255, 0, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    /*
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }*/ // à Bien mettre si on veut afficher sous forme de barchart
                });
            </script>
            </div>
            <div class="col-md-4 offset-md-2">
            <script src="home/js/Chart.min.js"></script>
            <canvas id="myChart2" width="200" height="200"></canvas>
            <script>
                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: lab,
                        datasets: [{
                            label: '# of Votes',
                            data: dat,
                            backgroundColor: [
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(119, 130, 255, 0.2)',
                                'rgba(70, 255, 242, 0.2)',
                                'rgba(255, 14, 150, 0.2)',
                                'rgba(209, 255, 60, 0.2)',
                                'rgba(16, 20, 255, 0.2)',
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(119, 130, 255, 0.2)',
                                'rgba(70, 255, 242, 0.2)',
                                'rgba(255, 14, 150, 0.2)',
                                'rgba(209, 255, 60, 0.2)',
                                'rgba(16, 20, 255, 0.2)',
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(119, 130, 255, 0.2)',
                                'rgba(70, 255, 242, 0.2)',
                                'rgba(255, 14, 150, 0.2)',
                                'rgba(209, 255, 60, 0.2)',
                                'rgba(16, 20, 255, 0.2)',
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                            ],
                            borderColor: [
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(119, 130, 255, 1)',
                                'rgba(70, 255, 242, 1)',
                                'rgba(255, 14, 150, 1)',
                                'rgba(209, 255, 60, 1)',
                                'rgba(16, 20, 255, 1)',
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 255, 0, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(119, 130, 255, 1)',
                                'rgba(70, 255, 242, 1)',
                                'rgba(255, 14, 150, 1)',
                                'rgba(209, 255, 60, 1)',
                                'rgba(16, 20, 255, 1)',
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 255, 0, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(119, 130, 255, 1)',
                                'rgba(70, 255, 242, 1)',
                                'rgba(255, 14, 150, 1)',
                                'rgba(209, 255, 60, 1)',
                                'rgba(16, 20, 255, 1)',
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 255, 0, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    } // à Bien mettre si on veut afficher sous forme de barchart
                });
            </script>
            </div>
    </div>