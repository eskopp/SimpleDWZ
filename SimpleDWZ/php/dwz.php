<?php

/**
 * Calculates the new DWZ (Deutsche Wertungszahl) based on the old DWZ, result, opponent's DWZ, and number of games played.
 *
 * @param int $oldDWZ The old DWZ.
 * @param float $result The result (0 for loss, 0.5 for draw, 1 for win).
 * @param int $opponentDWZ The opponent's DWZ.
 * @param int $playedGames The number of games played (default is 1).
 * @return int The new DWZ.
 */
function calculateDWZ($oldDWZ, $result, $opponentDWZ, $playedGames = 1)
{
    $ratingConstant = 32;
    $ratingFactor = 400;

    $expectedScore = 1 / (1 + pow(10, ($opponentDWZ - $oldDWZ) / $ratingFactor));
    $scoreIncrease = $ratingConstant * ($result - $expectedScore);
    $newDWZ = $oldDWZ + $scoreIncrease * $playedGames;

    return $newDWZ;
}

/**
 * Converts the result string to the score for the winning player.
 *
 * @param string $result The result string ("1-0" for win, "0.5-0.5" for draw).
 * @return float The score for the winning player (0 for loss, 0.5 for draw, 1 for win).
 */
function getScoreW($result)
{
    if ($result === "1-0") {
        return 1;
    } elseif ($result === "0.5-0.5") {
        return 0.5;
    } else {
        return 0;
    }
}

/**
 * Converts the result string to the score for the losing player.
 *
 * @param string $result The result string ("1-0" for win, "0.5-0.5" for draw).
 * @return float The score for the losing player (0 for win, 0.5 for draw, 1 for loss).
 */
function getScoreS($result)
{
    if ($result === "1-0") {
        return 0;
    } elseif ($result === "0.5-0.5") {
        return 0.5;
    } else {
        return 1;
    }
}

/**
 * Rounds a number to the nearest integer.
 *
 * @param float $number The number to round.
 * @return int The rounded integer value.
 */
function roundNumber($number)
{
    return intval(round($number));
}

/**
 * Generates a random UUID (Universally Unique Identifier) string.
 *
 * @param int $length The length of the UUID string (default is 16).
 * @return string The generated UUID.
 */
function generateUUID($length = 16)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';

    $randomString .= $characters[rand(10, 35)];
    $randomString .= $characters[rand(36, 61)];
    $randomString .= $characters[rand(0, 9)];

    for ($index = 3; $index < $length; $index++) {
        $randomString .= $characters[rand(0, 61)];
    }

    $randomString = str_shuffle($randomString);

    return $randomString;
}

/**
 * Checks if a UUID (Universally Unique Identifier) is valid.
 *
 * @param string $uuid The UUID to check.
 * @return bool True if the UUID is valid, false otherwise.
 */
function isUUIDValid($uuid)
{
    if (strlen($uuid) !== 10) {
        return false;
    }

    $hasUpperCase = false;
    $hasLowerCase = false;
    $hasNumber = false;

    for ($index = 0; $index < strlen($uuid); $index++) {
        $char = $uuid[$index];

        if (ctype_upper($char)) {
            $hasUpperCase = true;
        } elseif (ctype_lower($char)) {
            $hasLowerCase = true;
        } elseif (ctype_digit($char)) {
            $hasNumber = true;
        }
    }

    if (!$hasUpperCase || !$hasLowerCase || !$hasNumber) {
        return false;
    }

    return true;
}

?>
