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

// content 
$history = "White,DWZ_old,DWZ_new,Result,Black,DWZ_old,DWZ_new,Date,Time,DB_Fragment
Erik,1100,1108,1-0,Lara,900,892,20230626+,013402-,P0HuDZvcZsWsYuzP
Felix,900,902,0.5-0.5,Georg,950,948,20230626+,013413-,aCJLLl4JUSF0j6TK
Erik,1108,1103,0.5-0.5,Lena,1000,1005,20230626+,013428-,YHIfxf5FAMU0E73R
Erik,1103,1076,0-1,Sina,800,827,20230626+,013449-,Js35irqCnBTUVHsI
Georg,948,967,1-0,Lena,1005,986,20230626+,013518-,DwR0FMRiF2I9iAdm
Lara,892,879,0-1,Georg,967,980,20230626+,013525-,WhwpwHQlXPMEiKz5
Erik,1076,1088,1-0,Georg,980,968,20230626+,013539-,KEjU7Ylc2eCvldz6
Lena,986,966,0-1,Felix,902,922,20230626+,013607-,RkyGnHuB8ipTFXwb
";
$user = "Lara,900,892,879
Lena,1000,1005,986,966
Georg,950,948,967,980,968
Sina,800,827
Felix,900,902,922
Erik,1100,1108,1103,1076,1088
";
$table="Sina,827
Lara,879
Erik,1088
Georg,968
Lena,966
Felix,922
";


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

file_put_contents(substr(__DIR__, 0, -3).'/txt/history.txt', $history);
file_put_contents(substr(__DIR__, 0, -3).'/txt/table.txt', $table);
file_put_contents(substr(__DIR__, 0, -3).'/txt/user.txt', $user);
header("Location: ../?action=SampleDB");

?>