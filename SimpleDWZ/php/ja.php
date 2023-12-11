<?php
/**
 * Deletes a file if it exists.
 *
 * @param string $filePath The path to the file.
 * @return void
 */
function delete_file($filePath)
{
    if (file_exists($filePath)) {
        file_put_contents($filePath, '');
    }
}

/**
 * Generates a formatted date and time string.
 *
 * @return string The formatted date and time string.
 */
function xyz()
{
    return strval((new DateTime())->format('Ymd-His'));
}


$contentx = xyz();
$backupDir = substr(__DIR__, 0, -3)."backup/" . $contentx;
mkdir($backupDir);

$files = array(
    "table.txt",
    "user.txt",
    "history.txt"
);

foreach ($files as $file) {
    $source = substr(__DIR__, 0, -3)."txt/" . $file;
    $destination = $backupDir . "/" . $file;

    if (!copy($source, $destination)) {
        die("Backup could not be created.");
    }

    delete_file($source);
}

$txt = "White,DWZ_old,DWZ_new,Result,Black,DWZ_old,DWZ_new,Date,Time\n";
file_put_contents(substr(__DIR__, 0, -3).'/txt/history.txt', $txt);

header("Location: ../");

?>