<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
    <div class="card-header text-black themeColorBackgroung themeColorContent">
        <h3>Changement des vos informations personnelles</h3>
    </div>
    <div class="card-body">



        <?php
        if ($_SESSION['detailsChanged']) {
            require('home/dynamicContent/dynamicContent_detailsChanged.php');
        }
        ?>

        <?php
        if (isset($_SESSION['wrongRegisterLogin']) && $_SESSION['wrongRegisterLogin']) {
            echo "<h3 style='color:red'> Le login que vous désirez est déjà utilisé... </h3>";
        }
        ?>

        <form action="index.php?page=accountManagement&todo=changeDetails" method="post">
            <table class="table borderless twoEqualColumns">
                <tbody>
                    <tr>
                        <th scope="row">Nom</th>
                        <td><input type="text" placeholder='Nom' name="nom" <?php echo "value=";
                                                                            echo $_SESSION["nom"]; ?> /></td>
                    </tr>
                    <tr>
                        <th scope="row">Prénom</th>
                        <td><input type="text" placeholder='Prénom' name="prenom" <?php echo "value=";
                                                                                    echo $_SESSION["prenom"]; ?> /></td>
                    </tr>
                    <tr>
                        <th scope="row">Naissance</th>
                        <td><input type="date" id='naissance' placeholder='YYYY-mm-dd' name="naissance" <?php echo "value=";
                                                                                    echo $_SESSION["naissance"]; ?> required />
                            <div id="calendarMain" class="calendarMain"></div>
                            <script type="text/javascript">
                                //<![CDATA[
                                var myCalendar = new jsSimpleDatePickr();
                                myCalendar.CalAdd({
                                    'divId': 'calendarMain',
                                    'inputFieldId': 'naissance',
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
                        <th scope="row">Email</th>
                        <td><input type="email" placeholder='email' name="email" <?php echo "value=";
                                                                                    echo $_SESSION["email"]; ?> /></td>
                    </tr>
                    <tr>
                        <th scope="row">Login</th>
                        <td><input type="text" placeholder='login' name="login" <?php echo "value=";
                                                                                echo $_SESSION["login"]; ?> /></td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && ((isset($_POST["pwd1"]) && $_POST["pwd1"] != '') || (isset($_POST["pwd2"]) && $_POST["pwd2"] != '')) && $_POST["pwd1"] != $_POST["pwd2"]) {
                                            echo "style='color:red'";
                                        } ?>>Nouveau mot de passe (si vous le souhaitez)</th>
                        <td><input type="password" placeholder='Nouveau mot de passe' name='pwd1' /></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td><input type="password" placeholder='Confirmer' name='pwd2' /></td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongOldPassword']) && $_SESSION['wrongOldPassword']) {
                                            echo "style='color:red'";
                                        } ?>>Ancien mot de passe (confirmez votre identité)</th>
                        <td><input type="password" placeholder='Ancien mot de passe' name='oldPwd' /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister']) {
                                            echo "<p style='color:red'>Vérifiez certains champs !</p>";
                                        } ?> </th>
                        <td><input type='submit' value="Changement des informations"></td>
                    </tr>

                </tbody>
            </table>
        </form>








    </div>
</div>