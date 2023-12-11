<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Rating</title>
    <link rel="icon" href="../img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container {
            overflow-x: auto;
        }

        .table-container {
            width: max-content;
        }

        .table-container table {
            white-space: nowrap;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
    <div class="container">
        <center>
            <h1>Internal Rating</h1>
        </center>
        <br>
        <hr>
        <?php
        $filename = __DIR__ . "/../txt/history.txt";
        include __DIR__ . "/datum.php";
        echo "<h2>Game history</h2>";
        echo "<center>";
        echo '<div class="table-container">';
        echo "<table>\n";
        if (($file = fopen($filename, "r")) !== false) {
            $header = fgets($file);
            $headerColumns = explode(",", $header);
            echo "<tr>";
            foreach ($headerColumns as $column) {
                echo "<th>" . trim($column) . "</th>";
            }
            echo "</tr>\n";
            while (($line = fgets($file)) !== false) {
                $data = explode(",", $line);
                echo "<tr>";
                foreach ($data as $column) {
                    echo "<td>" . umrechneString(trim($column)) . "</td>";
                }
                echo "</tr>\n";
            }
            fclose($file);
        } else {
            echo "<tr><td colspan='4'>The file could not be opened.</td></tr>";
        }
        echo "</table>\n";
        echo "</div>";
        echo "</center>";
        print("<br><br><a href='../'><button>Back</button></a>");
        ?>
    </div>

    <!-- partial:index.partial.html -->
    <?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
