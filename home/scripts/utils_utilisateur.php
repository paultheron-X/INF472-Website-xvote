<?php
class utilisateur {
    // Attributs
    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $naissance;
    public $email;
    public $emailcheck;

    // Méthodes statiques
    public static function insererUtilisateur($dbh,$login,$mdp,$nom,$prenom,$naissance,$email) {
        if (utilisateur::getUtilisateur($dbh,$login) == null) {
            $sth = $dbh->prepare("INSERT INTO `users` (`login`, `mdp`, `nom`, `prenom`, `naissance`, `email`, `emailcheck`) VALUES(?,SHA1(?),?,?,?,?,?)");
            $sth->execute(array($login,$mdp,$nom,$prenom,$naissance,$email,0));
        }
    }

    public static function getUtilisateur($dbh,$login) {
        $sth = $dbh->prepare("SELECT * FROM `users` WHERE `login`= ?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array($login));
        if ($sth->rowCount() == 1) {
            $user = $sth->fetch();
            $sth->closeCursor();
            return $user;
        }
        else {
            return null;
        }
    }


    public static function testerMdp($user, $MyMdp) {
        return ($user != null && get_class($user)=='utilisateur' && $user->mdp == sha1($MyMdp) );
    }


    public static function changerUtilisateur($dbh,$login,$mdp,$nom,$prenom,$naissance,$email) {
        $sth = $dbh->prepare("UPDATE `users` SET `login`=?, `mdp`=SHA1(?), `nom`=?, `prenom`=?, `naissance`=?, `email`=? WHERE `login`=?");
        $sth->execute(array($login,$mdp,$nom,$prenom,$naissance,$email,$login));
    }


    public static function supprimerUtilisateur($dbh,$login) {
        $sth = $dbh->prepare("DELETE FROM `users` WHERE `login`=?");
        $sth->execute(array($login));
    }



// Méthodes dynamiques
    public function __toString() {


        $date=explode('-',$this->naissance);
        $date = $date[2].'/'.$date[1].'/'.$date[0];
        

        return "[$this->login] $this->prenom <b>$this->nom</b>, né le $date, <b>$this->email</b>";
    }

}

?>