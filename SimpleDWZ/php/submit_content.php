<?php
/**
 * behaltenVorErstemKomma Function
 *
 * Returns the part of a string before the first comma.
 *
 * @param string $str The input string.
 * @return string The part of the string before the first comma, or the entire string if no comma is present.
 */
function behaltenVorErstemKomma($str) {
    $index = strpos($str, ",");
    return $index !== false ? substr($str, 0, $index) : $str;
}

/**
 * abschneidenDWZ Function
 *
 * Returns the part of a string after the first comma.
 *
 * @param string $str The input string.
 * @return string The part of the string after the first comma, or the entire string if no comma is present.
 */
function abschneidenDWZ($str) {
    $index = strpos($str, ",");
    return $index !== false ? substr($str, $index + 1) : $str;
}
?>
