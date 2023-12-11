<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include __DIR__."/system.php";
include __DIR__ . "/dwz.php";
$filePath = substr(__DIR__, 0, -3).'/txt/table.txt';

function readLinesFromFile($filePath)
{
    $lines = [];
    if (file_exists($filePath)) {
        $fileHandle = fopen($filePath, 'r');
        if ($fileHandle) {
            while (($line = fgets($fileHandle)) !== false) {
                $lines[] = $line;
            }
            fclose($fileHandle);
        } else {
            echo "Error opening the file.";
        }
    } else {
        echo "The file does not exist.";
    }
    return $lines;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal rating</title>
    <link rel="icon" href="/img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src=" <?php echo __DIR__."/js/Form_New_Child.js"?>" ></script>
</head>

<body>
    <div class="container">
        <h1> Internal rating </h1>
        <hr>
        <h2> Report result: </h2>
        <form action="/php/submit.php" method="POST">
            <label for="message">Weiß:</label>
            <select size="1" name="weiss">
                <?php
                $lines = readLinesFromFile($filePath);
                foreach ($lines as $line) {
                    echo "<option>" . $line . "</option>";
                }
                ?>
            </select> <br> <br> <br>
            <label for="message">Black:</label>
            <select size="1" name="schwarz">
                <?php
                $lines = readLinesFromFile($filePath);
                foreach ($lines as $line) {
                    echo "<option>" . $line . "</option>";
                }
                ?>
            </select> <br> <br> <br>

            <label for="message">Result:</label>
            <select size="1" name="result">
                <option>1-0</option>
                <option>0-1</option>
                <option>0.5-0.5</option>
            </select> <br><br>
            <input type="hidden" name="db_key" value="<?php echo generateUUID(); ?>">
            <button type="submit">Report result</button>
        </form>
        <a href="index.php" target="_self"><button type="button">Back</button></a><br>

        <br><br>
    </div>
    <!-- partial:index.partial.html -->
    <?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
