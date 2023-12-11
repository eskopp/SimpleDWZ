<?php

/**
 * Check PHP Version
 *
 * Checks if the installed PHP version is compatible with the required version.
 *
 * @return void
 * @throws Exception If the installed PHP version is lower than the required version.
 */
function checkPHPVersion()
{
    $requiredVersion = '8.1.0';
    if (version_compare(PHP_VERSION, $requiredVersion, '<')) {
        die("The installed PHP version is lower than $requiredVersion.");
    }
}


?>
