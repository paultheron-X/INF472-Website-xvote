<?php

class uploadCSV {
    public static function readCSV($csvPath){
        $file = fopen($csvPath, 'r');
        $compteur = 0;
        while (!feof($file) && $compteur<10000 ) {
            $line[] = fgetcsv($file, 1024);
            $compteur = $compteur+1;
        }
        fclose($file);
        return $line;
    }

    public static function pushToDB($dbh,$csvPath,$surveyid){
        $myArray = uploadCSV::readCSV($csvPath);
        foreach($myArray as $index=>$value) {
            if (gettype($value) == 'array') {
                foreach($value as $index2=>$email){
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        voters::ajoutAutomatiqueVoter($dbh,$email,$surveyid);
                    }
                }
            }
        }
    }

    public static function checkSize($csvPath){
        if (filesize($csvPath) > 1000000) {
            return FALSE;
        }
        return TRUE;
    }


}