<?php
class Database
{
    public static function connect()
    {

        // To change
        $dsn = 'mysql:dbname=XVote;host=localhost';
        $user = 'root';
        $password = '';

        // Code
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }
}
