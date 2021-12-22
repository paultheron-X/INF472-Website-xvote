<?php
    if (isset($_SESSION['wrongPwd']) && $_SESSION['wrongPwd']) {
        $submitMessage = "Réessayer";
    }
    else {
        $submitMessage = "Connexion";
    }

?>


<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
        <div class="card-header text-black themeColorBackgroung themeColorContent">
            <h3>Déjà inscrit ? Connectez-vous !</h3>
        </div>
        <div class="card-body">


            <form action="index.php?page=account&todo=login" method="post">
                <table class="table borderless twoEqualColumns">
                    <tbody>
                        <tr>
                            <th scope="row">Login</th>
                            <td><input type="text" placeholder='login' name="login" required /></td>
                        </tr>
                        <tr>
                            <th scope="row">Password</th>
                            <td><input type="password" placeholder='password' name='pwd' required/></td>
                        </tr>
                        <tr>
                            <th scope="row"> </th>
                            <td><input type='submit' value=<?php echo $submitMessage ?> ></td>
                        </tr>

                    </tbody>
                </table>
            </form>


        </div>
</div>