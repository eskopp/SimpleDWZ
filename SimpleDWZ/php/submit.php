<?php
// PHP ERROR
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Load PHP Version
include __DIR__."/system.php";
include __DIR__."/dwz.php";
include __DIR__."/submit_content.php";
include __DIR__."/datum.php";


// Load Vars
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['weiss']) && isset($_POST['schwarz']) && isset($_POST['result']) && isset($_POST['db_key'])) {
        $weiss = $_POST['weiss'];
        $schwarz = $_POST['schwarz'];
        $result = $_POST['result'];
        $db_key = $_POST['db_key'];
    } else {
        die("Not all required fields were passed.");
    }
} else {
    die("Invalid request method. A POST request is expected.");
}

// DWZ Content
$name_weiss = behaltenVorErstemKomma($weiss);
$name_schwarz = behaltenVorErstemKomma($schwarz);
$weiß_dwz = abschneidenDWZ($weiss);
$schwarz_dwz = abschneidenDWZ($schwarz);
$schwarz_dwz_neu = roundNumber(calculateDWZ($schwarz_dwz,getScoreS($result),$weiß_dwz));
$weiß_dwz_neu = roundNumber(calculateDWZ($weiß_dwz,getScoreW($result),$schwarz_dwz));
$weiss_tupel = $name_weiss.",".$weiß_dwz_neu;
$schwarz_tupel = $name_schwarz.",".$schwarz_dwz_neu;
$test = isUUIDValid($db_key) ? "true" : "false";
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <title>Internal Rating</title>
    <link rel="icon" href="../img/logo.png" >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body><div class="container">

    <h1> Internal Rating</h1><hr>
<?php
$file_path = substr(__DIR__, 0, -3).'/txt/history.txt';

if (file_exists($file_path) && is_readable($file_path)) {
    $file = fopen($file_path, 'r');

  
    while (($line = fgets($file)) !== false) {
        if (strpos($line, $db_key) !== false) {
            $db_error = $line; 
            break; 
        }
    }

    fclose($file);
}

if (!isset($db_error)) {
    $db_error = false; 
}

if ($db_error) {
    echo "<h2> Error  </h2><br><br><br>";
    echo "Conflicting games:<br><br><br>";
    echo "<div class='table-container'>";
    $db_error = "Weiss,DWZ_alt,DWZ_neu,Ergebnis,Schwarz,DWZ_alt,DWZ_neu,Datum,Zeit,Alive?\n".$db_error;
    $rows = explode("\n", $db_error);

    $table_html = '<table>' . PHP_EOL . '<thead>' . PHP_EOL . '<tr>' . PHP_EOL;
    $header = explode(",", $rows[0]);
    foreach ($header as $column) {
        $table_html .= '<th>' . $column . '</th>' . PHP_EOL;
    }
    $table_html .= '</tr>' . PHP_EOL . '</thead>' . PHP_EOL . '<tbody>' . PHP_EOL;

    for ($i = 1; $i < count($rows); $i++) {
        $table_html .= '<tr>' . PHP_EOL;
        $columns = explode(",", $rows[$i]);
        foreach ($columns as $column) {
            $table_html .= '<td>' . $column . '</td>' . PHP_EOL;
        }
        $table_html .= '</tr>' . PHP_EOL;
    }

    $table_html .= '</tbody>' . PHP_EOL . '</table>';

    echo $table_html;
    echo "</div>";
    echo "<hr><br> Please consider that the game above you has already been entered into the database.";
    
    die("<a href='https://intern.liffecs.de/php/result.php?error=db_key' target='_self'><button type='button'>New result</button></a><br>");
}

if(isUUIDValid($db_key)){
    echo "Internal Error <br><br><br>";
    echo "Bitte geben Sie dem Admin bescheid";
    die("<a href='https://intern.liffecs.de/php/result.php' target='_self'><button type='button'>New result</button></a><br>");
}

if($name_weiss == $name_schwarz){
    
    echo "This pairing can not be accepted<br><br><br>";
    echo "How to play ".$name_weiss." against ".$name_schwarz."? <br><br><br>";
    die("<a href='https://intern.liffecs.de/php/result.php' target='_self'><button type='button'>New result</button></a><br>");
}

echo "<div class='table-container'>";
echo "<table>";
echo '<tr><th>Wert</th><th>Typ</th></tr>';
echo "<tr>";
echo "<td>".$name_schwarz."</td>";
echo "<td>name_schwarz</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$name_weiss."</td>";
echo "<td>name_weiss</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$weiß_dwz."</td>";
echo "<td>weiß_dwz</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$schwarz_dwz."</td>";
echo "<td>schwarz_dwz</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$schwarz_dwz_neu."</td>";
echo "<td>schwarz_dwz_neu</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$weiß_dwz_neu."</td>";
echo "<td>weiss_dwz_neu</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$result."</td>";
echo "<td>result</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".getScoreW($result)."</td>";
echo "<td>getScoreW()</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".getScoreS($result)."</td>";
echo "<td>getScoreS()</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$db_key."</td>";
echo "<td>DB Key Fragment</td>";
echo "</tr>";
echo "</table>";
echo "</div>";



$filename = substr(__DIR__, 0, -3).'/txt/table.txt';
$lines = file($filename);
$updatedContent = '';
$lineDeleted = false;

foreach ($lines as $line) {
    if (strpos($line, $name_weiss) !== false) {
        $lineDeleted = true;
        continue;
    }
    $updatedContent .= $line;
}

if ($lineDeleted) {
    file_put_contents($filename, $updatedContent . $weiss_tupel . PHP_EOL, LOCK_EX);
} else {
    echo "Eintrag für $name_weiss nicht gefunden.";
}


$filename = substr(__DIR__, 0, -3).'/txt/table.txt';


$lines = file($filename);
$updatedContent = '';
$lineDeleted = false;

foreach ($lines as $line) {
    if (strpos($line, $name_schwarz) !== false) {
        $lineDeleted = true;
        continue;
    }
    $updatedContent .= $line;
}

if ($lineDeleted) {
    file_put_contents($filename, $updatedContent . $schwarz_tupel . PHP_EOL, LOCK_EX);
} else {
    echo "Eintrag für $name_schwarz nicht gefunden.";
}


$filename = substr(__DIR__, 0, -3) . '/txt/user.txt';

// Update content for $name_weiss
$file = fopen($filename, 'r+');
if ($file) {
    $newContent = '';
    while (($line = fgets($file)) !== false) {
        if (strpos($line, $name_weiss) !== false) {
            $line = rtrim($line);
            $line .= ',' . $weiß_dwz_neu . "\n";
        }
        $newContent .= $line;
    }
    fclose($file);
    file_put_contents($filename, $newContent);
    echo " ";
} else {
    echo "The file could not be opened.";
}

// Update content for $name_schwarz
$file = fopen($filename, 'r+');
if ($file) {
    $newContent = '';
    while (($line = fgets($file)) !== false) {
        if (strpos($line, $name_schwarz) !== false) {
            $line = rtrim($line);
            $line .= ',' . $schwarz_dwz_neu . "\n";
        }
        $newContent .= $line;
    }
    fclose($file);
    file_put_contents($filename, $newContent);
    echo " ";
} else {
    echo "The file could not be opened.";
}



$file = substr(__DIR__, 0, -3) . '/txt/history.txt';
$date = date("Ymd") . "+";
$time = date("His") . "-";
$newLine = $name_weiss . "," . $weiß_dwz . "," . $weiß_dwz_neu . "," . $result . "," . $name_schwarz . "," . $schwarz_dwz . "," . $schwarz_dwz_neu . "," . $date . "," . $time . "," . $db_key . "\n";

if (file_put_contents($file, $newLine, FILE_APPEND | LOCK_EX) !== false) {
    echo " ";
} else {
    echo "The file could not be opened.";
}

?>

<a href="index.php" target="_self"><button type="button">Back</button></a><br>
<a href="/php/result.php" target="_self"><button type="button">Neues Ergebnis</button></a><br>
</div>
<!-- partial:index.partial.html -->
<?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</div>
<svg style="position:fixed; top:100vh;">
  <defs>
    <filter id="blob">
      <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
      <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="blob"></feColorMatrix>
      <feComposite in="SourceGraphic" in2="blob" operator="atop"></feComposite>
    </filter>
  </defs>
</svg>
</body>
</html>
