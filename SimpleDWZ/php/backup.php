<?php
include __DIR__ . "/datum.php";

function generateTable()
{
    
    $directory = substr(__DIR__, 0, -3). 'backup';
    $files = scandir($directory);

    echo '<div class="table-container">';
    echo '<table>';
    echo '<tr><th>Date</th><th>Time</th><th>Data Set</th></tr>';

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        if ($file === 'Test-Data') {
            $filePath = $directory . '/' . $file;
                    echo '<tr>';
                    echo '<td> Test Data</td>';
                    echo '<td> Test Data </td>';
                    echo "<td><a href='../backup/Test-Data'>Download</a></td>";
                    echo '</tr>';
                }else{

                        $filePath = $directory . '/' . $file;

                        if (is_dir($filePath)) {
                            $fileName = explode('-', $file);
                            $column1 = $fileName[0];
                            $column2 = $fileName[1];

                            echo '<tr>';
                            echo '<td>' . umrechneDatum($column1) . '</td>';
                            echo '<td>' . umrechneUhrzeit($column2) . '</td>';
                            echo "<td><a href='../backup/".$file."'>Download</a></td>";
                            echo '</tr>';
                        }
                 }
    }

    echo '</table>';
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Rating</title>
    <link rel="icon" href="../img/logo.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/style/style.css">
</head>

<body>
    <div class="container">
        <h1>Internal Rating</h1>
        <br>
        <hr>
        <h2>BackUp</h2>
        <center>
            <?php generateTable(); ?>
        </center>
        <br>
        <br>
        <a href="../"><button>Back</button></a>
    </div>
    <!-- partial:index.partial.html -->
    <?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
