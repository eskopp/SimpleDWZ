<!DOCTYPE html>
<html lang="en">
<head>
    <title>Internal Rating</title>
    <link rel="icon" href="../img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/div.css">
</head>
<body>
    <div class="container">
        <h2>Ratingtable</h2><br>
        <h3>
                <div class="tablex">
                    <center>
                        <?php
                        $filePath =  substr(__DIR__, 0, -3).'/txt/table.txt';
                        if (file_exists($filePath)) {
                            $lines = file($filePath, FILE_IGNORE_NEW_LINES);
                            if (isset($_GET['sort'])) {
                                $sort = $_GET['sort'];
                                if ($sort === 'name-asc') {
                                    usort($lines, function ($a, $b) {
                                        return strcmp(explode(',', $a)[0], explode(',', $b)[0]);
                                    });
                                } elseif ($sort === 'name-desc') {
                                    usort($lines, function ($a, $b) {
                                        return strcmp(explode(',', $b)[0], explode(',', $a)[0]);
                                    });
                                } elseif ($sort === 'rating-asc') {
                                    usort($lines, function ($a, $b) {
                                        return (int) explode(',', $a)[1] - (int) explode(',', $b)[1];
                                    });
                                } elseif ($sort === 'rating-desc') {
                                    usort($lines, function ($a, $b) {
                                        return (int) explode(',', $b)[1] - (int) explode(',', $a)[1];
                                    });
                                }
                            }
                            echo '<div class="table-container">';
                            echo '<table>';
                            echo '<tr><th>Name</th><th>Rating</th></tr>';
                            foreach ($lines as $line) {
                                [$name, $rating] = explode(',', $line);
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($name) . '</td>';
                                echo '<td>' . htmlspecialchars($rating) . '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                            echo '</div>';
                            echo '</div>';
                            echo '<hr><br><br>';
                            echo '<div>';
                            echo '<a href="?sort=name-asc"><button type="button">Name ascending</button></a>';
                            echo '<a href="?sort=name-desc"><button type="button">Name descending</button></a><br>';
                            echo '<a href="?sort=rating-asc"><button type="button">Rating ascending</button></a>';
                            echo '<a href="?sort=rating-desc"><button type="button">Rating descending</button></a>';
                            echo '</div>';
                            echo '<br><br>';
                        } else {
                            echo "File does not exist.";
                        }
                        echo '<hr><br><br>';
                        ?>
                        <a href="../">
                            <button type="button">Back</button>
                        </a>
                    </center>
            </div>
        </h3>
    </div>
    <!-- partial:index.partial.html -->
    <?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>
</html>
