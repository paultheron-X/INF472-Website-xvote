<?php

if (FALSE) {
    $submitMessage = "Vérifiez tous les champs !!!";
} else {
    $submitMessage = "";
}

?>

<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
    <div class="card-header text-black themeColorBackgroung themeColorContent">
        <h3>Nouveau par ici ? Inscrivez-vous en moins de 2 minutes !</h3>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['wrongRegisterLogin']) && $_SESSION['wrongRegisterLogin']) {
            echo "<h3 style='color:red'> Le login que vous désirez est déjà utilisé... </h3>";
        } ?>
        <form action="index.php?page=account&todo=register" method="post">
            <table class="table borderless twoEqualColumns">
                <tbody>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && (!isset($_POST["nom"]) || $_POST["nom"] == '')) {
                                            echo "style='color:red'";
                                        } ?>>Nom*</th>
                        <td><input type="text" placeholder='Nom' name="nom" <?php if (isset($_POST["nom"]) && $_POST["nom"] != '') {
                                                                                echo "value=";
                                                                                echo htmlspecialchars($_POST["nom"]);
                                                                            } ?> required /></td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && (!isset($_POST["prenom"]) || $_POST["prenom"] == '')) {
                                            echo "style='color:red'";
                                        } ?>>Prénom*</th>
                        <td><input type="text" placeholder='Prénom' name="prenom" <?php if (isset($_POST["prenom"]) && $_POST["prenom"] != '') {
                                                                                        echo "value=";
                                                                                        echo htmlspecialchars($_POST["prenom"]);
                                                                                    } ?> required /></td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && (!isset($_POST["naissance"]) || $_POST["naissance"] == '' || !verifyDate($_POST["naissance"]))) {
                                            echo "style='color:red'";
                                        } ?>>Naissance*</th>
                        <td><input type="date" id='naissance' placeholder='YYYY-mm-dd' name="naissance" <?php if (isset($_POST["naissance"]) && $_POST["naissance"] != '') {
                                                                                                            echo "value=";
                                                                                                            echo htmlspecialchars($_POST["naissance"]);
                                                                                                        } ?> required />
                            <div id="calendarMain" class="calendarMain"></div>
                            <script type="text/javascript">
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
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && (!isset($_POST["naissance"]) || $_POST["naissance"] == '')) {
                                            echo "style='color:red'";
                                        } ?>>Email*</th>
                        <td><input type="email" placeholder='email' name="email" <?php if (isset($_POST["email"]) && $_POST["email"] != '') {
                                                                                        echo "value=";
                                                                                        echo htmlspecialchars($_POST["email"]);
                                                                                    } ?> required /></td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && (!isset($_POST["login"]) || $_POST["login"] == '')) {
                                            echo "style='color:red'";
                                        } ?>>Login*</th>
                        <td><input type="text" placeholder='login' name="login" <?php if (isset($_POST["login"]) && $_POST["login"] != '') {
                                                                                    echo "value=";
                                                                                    echo htmlspecialchars($_POST["login"]);
                                                                                } ?> required /></td>
                    </tr>
                    <tr>
                        <th scope="row" <?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister'] && (!isset($_POST["pwd1"]) || !isset($_POST["pwd2"]) || $_POST["pwd1"] == '' || $_POST["pwd1"] != $_POST["pwd2"])) {
                                            echo "style='color:red'";
                                        } ?>>Password*</th>
                        <td><input type="password" placeholder='Password' name='pwd1' required /></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td><input type="password" placeholder='Confirmer' name='pwd2' required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php if (isset($_SESSION['wrongRegister']) && $_SESSION['wrongRegister']) {
                                            echo "<p style='color:red'>Vérifiez tous les champs !</p>";
                                        } ?> </th>
                        <td><input type='submit' value="Je m'inscris !"></td>
                    </tr>

                </tbody>
            </table>
        </form>

    </div>
</div>