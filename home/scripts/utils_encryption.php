<?php
class encryption {
    public static function votersKey() {
        // Clé unique utilisée pour l'encryption d'un lien individuel pour les votants
        // Évidemment, cette clé ne doit pas être communiquée à l'extérieur...
        return "*******************************";
    }

    public static function domain() {
        // Version locale
        return 'localhost/xvote-v24';

    }
}