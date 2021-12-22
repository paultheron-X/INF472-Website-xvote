<div class="card border-dark produitsPhares" data-aos="fade-up" data-aos-duration="1000">
        <div class="card-header text-black themeColorBackgroung themeColorContent">
            <h3>Supprimer votre compte</h3>
        </div>
        <div class="card-body">
            




<form action="index.php?page=account&todo=signOut" method="post">
    <p>XVote n'est pas à la hauteur de vos attentes ? Vous pouvez nous suggérer des améliorations via notre espace client.</p>
    <p>Si malgré tout vous souhaitez supprimer votre compte, c'est possible, en saisissant votre mot de pass ci-dessous.</p>
    <table class="table borderless twoEqualColumns">
        <tbody>

            <tr>
                <th scope="row" <?php if (isset($_SESSION['wrongOldPassword']) && $_SESSION['wrongOldPassword']) {echo "style='color:red'";} ?> >Mot de passe (confirmez votre identité)</th>
                <td><input type="password" placeholder='Mot de passe' name='oldPwd' /></td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td><input type='submit' value="Je quitte XVote" ></td>
            </tr>

        </tbody>
    </table>
</form>








        </div>
    </div>