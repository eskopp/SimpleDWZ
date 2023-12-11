<!DOCTYPE html>
<html lang="en">
 
<head>
    <title>Internal Rating</title>
    <link rel="icon" href="../img/logo.png" >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/div.css">
    

</head>

<body>
<div class="container">
<h1> Internal Rating </h1> <br> <hr>   
<?php
// Aktueller Pfad
$currentPath = __DIR__."/";


// Lade Daten aus dem POST-Array
include $currentPath."dwz.php";
$child = $_POST["balg"];
$rating = $_POST["rating"];


// Testen der Daten
if (!preg_match('/^[1-9][0-9]*$/', $rating) && $rating !== '0') {
    echo "{$rating} ist keine normale ganze Zahl.";
    die("<br><br><a href='../'><button>Back</button></a>");
}

if (!preg_match('/^[1-9][0-9]*$/', $rating) && $rating !== '0') {
    echo "{$rating} ist keine normale ganze Zahl.";
    die("<br><br><a href='../'><button>Back</button></a>");
}

if ($rating <= 799){
    echo "Das Rating darf nicht unter 800 sein (".$rating.")";
    die("<br><br><a href='../'><button>Back</button></a>");
}
if (strlen($child) < 3){
    echo "Der Name muss mindestens 3 Zeichen haben (".$child.")";
    die("<br><br><a href='../'><button>Back</button></a>");
}   

if (strlen($child) > 12){
    echo "Der Name muss weniger als 12 Zeichen haben (".$child.")";
    die("<br><br><a href='../'><button>Back</button></a>");  
}   

if (preg_match('/\s|[^\w\s]/', $child)){
    echo "Error: Sonderzeichen";
    echo "Bitte entferne die Sonderzeichen (".$child.")";
    die("<br><br><a href='../'><button>Back</button></a>");
}

if (preg_match('/^[a-zA-Z]+$/', $child) == False){
    echo "Sonderzeichen II";
    echo "Bitte gib einen normalen Namen ein (".$child.")";
    die("<br><br><a href='../'><button>Back</button></a>");
}

$rating = roundNumber($rating);

$tableFile = substr(__DIR__, 0, -3)."/txt/table.txt";

if (!file_exists($tableFile)) {
    touch($tableFile);
    chmod($tableFile, 0644);
}

$fileHandle = fopen($tableFile, 'a+');

if ($fileHandle) {
    if (flock($fileHandle, LOCK_EX)) {
        fseek($fileHandle, 0);
        
        $fileContent = file_get_contents($tableFile);
        
        if (strpos($fileContent, $child) === false) {
            fwrite($fileHandle, $child . "," . $rating . "\n");
            echo "TABLE: Eintrag angelegt. <br><br>";
        } else {
            echo "TABLE: Eintrag existiert bereits. <br><br>";
        }
        
        flock($fileHandle, LOCK_UN);
    } else {
        echo "Fehler beim Sperren der CSV-Datei.";
    }

    fclose($fileHandle);
}

$currentPath = __DIR__;

$child = $_POST["balg"];
$rating = $_POST["rating"];

$tableFile = substr(__DIR__, 0, -3)."/txt/user.txt";

if (!file_exists($tableFile)) {
    touch($tableFile);
    chmod($tableFile, 0644);
}

$fileHandle = fopen($tableFile, 'a+');

if ($fileHandle) {
    if (flock($fileHandle, LOCK_EX)) {
        fseek($fileHandle, 0);
        
        $fileContent = file_get_contents($tableFile);
        
        if (strpos($fileContent, $child) === false) {
            fwrite($fileHandle, $child . "," . $rating . "\n");
            echo "USER: Eintrag angelegt. <br><br>";
        } else {
            echo "USER: Eintrag existiert bereits. <br><br>";
        }
        
        flock($fileHandle, LOCK_UN);
    } else {
        echo "Fehler beim Sperren der CSV-Datei.";
    }

    fclose($fileHandle);
}

print("<br><br><a href='../'><button>Back</button></a>");

?>
</div>
<!-- partial:index.partial.html -->
<?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
