
    <div class="container">

        <?php
        if ($_SESSION['loggedIn']) {
            if (isset($_SESSION['newMember']) && $_SESSION['newMember']) {
                require('home/dynamicContent/dynamicContent_newMemberCongrats.php');
            } else {
                require('home/dynamicContent/dynamicContent_oldMemberWelcome.php');
            }

            require('home/dynamicContent/dynamicContent_accountLoggedIn.php');
        } else {
            require('home/dynamicContent/dynamicContent_logInForm.php');
            require('home/dynamicContent/dynamicContent_registerForm.php');
        }

        ?>

    </div>
