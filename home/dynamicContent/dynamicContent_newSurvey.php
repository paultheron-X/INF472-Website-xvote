<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
    <div class="card-header text-black themeColorBackgroung themeColorContent">
        <h3>Créer un nouveau vote</h3>
    </div>
    <div class="card-body">



        <form action="index.php?page=myVotes&todo=newSurvey" method="post">
            <table class="table borderless twoEqualColumns">
                <tbody>

                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongSurvey']) && $_SESSION['wrongSurvey'] && !(isset($_POST["type"]) && ($_POST["type"] == 'Scrutin uninomial' || $_POST["type"] == 'Méthode de Borda'))) {
                                            echo "style='color:red'";
                                        } ?>>Type*</th>
                        <td>
                            <select placeholder='Type de vote' name="type" <?php if (isset($_POST["type"]) && $_POST["type"] != '') {
                                                                                echo "value=";
                                                                                echo htmlspecialchars($_POST["type"]);
                                                                            } ?> required>
                                <option> Scrutin uninomial
                                <option> Méthode de Borda
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongSurvey']) && $_SESSION['wrongSurvey'] && (!isset($_POST["enddate"]) || $_POST["enddate"] == '' || !verifydate($_POST['enddate']))) {
                                            echo "style='color:red'";
                                        } ?>>Date de fin*</th>
                        <td><input id= "datefin" type="date" placeholder='dd/mm/YYYY' name="enddate" <?php if (isset($_POST["enddate"]) && $_POST["enddate"] != '') {
                                                                                            echo "value=";
                                                                                            echo htmlspecialchars($_POST["enddate"]);
                                                                                        } ?> required />
                            <div id="calendarMain" class="calendarMain"></div>
                            <script type="text/javascript">
                                //<![CDATA[
                                var myCalendar = new jsSimpleDatePickr();
                                myCalendar.CalAdd({
                                    'divId': 'calendarMain',
                                    'inputFieldId': 'datefin',
                                    'dateMask': 'AAAA-MM-JJ',
                                    'dateCentury': 20,
                                    'titleMask': 'M AAAA',
                                    'navType': '11',
                                    'classTable': 'jsCalendar',
                                    'classDay': 'day',
                                    'classDaySelected': 'selectedDay',
                                    'monthLst': ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                    'dayLst': ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                                    'hideOnClick': true,
                                    'showOnLaunch': false
                                });
                                //]]>
                            </script>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongSurvey']) && $_SESSION['wrongSurvey'] && (!isset($_POST["endtime"]) || $_POST["endtime"] == '' || !verifyTime($_POST['endtime']))) {
                                            echo "style='color:red'";
                                        } ?>>Heure de fin*</th>
                        <td><input type="time" placeholder='--:--' name="endtime" <?php if (isset($_POST["enddate"]) && $_POST["endtime"] != '') {
                                                                                        echo "value=";
                                                                                        echo htmlspecialchars($_POST["endtime"]);
                                                                                    } ?> required /></td>
                    </tr>

                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongSurvey']) && $_SESSION['wrongSurvey'] && (!isset($_POST["surveyname"]) || $_POST["surveyname"] == '')) {
                                            echo "style='color:red'";
                                        } ?>>Nom du vote*</th>
                        <td><input type="text" placeholder='Nom' name="surveyname" <?php if (isset($_POST["surveyname"]) && $_POST["surveyname"] != '') {
                                                                                        echo "value=";
                                                                                        echo htmlspecialchars($_POST['surveyname']);
                                                                                    } ?> required /></td>
                    </tr>

                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongSurvey']) && $_SESSION['wrongSurvey'] && (!isset($_POST["description"]) || $_POST["description"] == '')) {
                                            echo "style='color:red'";
                                        } ?>>Description du vote*</th>
                        <td><input type="text" placeholder='Quelques mots pour parler de votre vote...' name="description" <?php if (isset($_POST["description"]) && $_POST["description"] != '') {
                                                                                                                                echo "value=";
                                                                                                                                echo htmlspecialchars($_POST['description']);
                                                                                                                            } ?> required /></td>
                    </tr>

                    <tr>
                        <th scope="row"><?php if (isset($_SESSION['wrongSurvey']) && $_SESSION['wrongRegister']) {
                                            echo "<p style='color:red'>Vérifiez tous les champs !</p>";
                                        } ?> </th>
                        <td><input type='submit' value="Créer mon vote !"></td>
                    </tr>

                </tbody>
            </table>
        </form>

    </div>
</div>