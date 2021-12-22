<?php

function verifyDate($date) {
    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function verifyDateTime($date) {
    $format = 'Y-m-d H:i';
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function verifyTime($date) {
    $format = 'H:i';
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function checkEndDate($dbh,$survey) {
    if (date("Y-m-d H:i:s")>$survey->enddate) {
        survey::changerSurvey($dbh,$survey->surveyid,$survey->enddate,$survey->surveyname,$survey->description,2,$survey->options);
        $survey->status = 2;
    }
}



