<?php
/**
 * Converts a date in the format YYYYMMDD to the format DD.MM.YYYY.
 *
 * @param string $datum The input date in the format YYYYMMDD.
 * @return string The converted date in the format DD.MM.YYYY.
 */
function umrechneDatum($datum) {
    $jahr = substr($datum, 0, 4);
    $monat = substr($datum, 4, 2);
    $tag = substr($datum, 6, 2);

    $umgerechnetesDatum = $tag . '.' . $monat . '.' . $jahr;

    return $umgerechnetesDatum;
}


/**
 * Converts a time in the format HHMMSS to the format HH:MM:SS.
 *
 * @param string $uhrzeit The input time in the format HHMMSS.
 * @return string The converted time in the format HH:MM:SS.
 */
function umrechneUhrzeit($uhrzeit) {
    $stunden = substr($uhrzeit, 0, 2);
    $minuten = substr($uhrzeit, 2, 2);
    $sekunden = substr($uhrzeit, 4, 2);

    $umgerechneteUhrzeit = $stunden . ':' . $minuten . ':' . $sekunden;

    return $umgerechneteUhrzeit;
}


/**
 * Converts a string based on specific rules.
 *
 * If the string ends with '-', it is considered a time and converted using umrechneUhrzeit function.
 * If the string ends with '+', it is considered a date and converted using umrechneDatum function.
 * If the string doesn't match any rules, it is returned as is.
 *
 * @param string $eingabe The input string to be converted.
 * @return string The converted string based on the rules.
 */
function umrechneString($eingabe) {
    $laenge = strlen($eingabe);
    
    if ($laenge > 0) {
        $endung = substr($eingabe, -1);

        if ($endung === '-') {
            $uhrzeit = substr($eingabe, 0, -1);
            return umrechneUhrzeit($uhrzeit);
        } elseif ($endung === '+') {
            $datum = substr($eingabe, 0, -1);
            return umrechneDatum($datum);
        }
    }
    
    return $eingabe;
}


?>