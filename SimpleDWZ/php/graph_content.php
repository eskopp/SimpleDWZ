<?php
declare(strict_types=1);

/**
 * Function: getcolor
 * Generates a random RGBA color.
 *
 * @return string The generated color in RGBA format.
 */
function getcolor(): string {
    $red = mt_rand(0, 255);
    $green = mt_rand(0, 255);
    $blue = mt_rand(0, 255);
    $alpha = 1;
    return "rgba($red, $green, $blue, $alpha)";
}

/**
 * Function: generateCodeBlocks
 * Generates code blocks for the specified js enviroments.
 *
 * @return string The generated code blocks.
 */
function generateCodeBlocks(): string {
    $filePath = substr(__DIR__, 0, -3) . '/txt/user.txt';
    $codeBlocks = '';

    if (file_exists($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode(',', $line);
            $dataset = trim($parts[0]);
            $numbers = array_map('trim', array_slice($parts, 1));

            $codeBlocks .= "
            {
                label: '$dataset',
                data: [" . implode(', ', $numbers) . "],
                borderColor: '" . getcolor() . "',
                fill: false
            },";
        }
    } else {
        return 'File not found.';
    }

    return $codeBlocks;
}

?>
