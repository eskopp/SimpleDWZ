<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Rating</title>
    <link rel="icon" href="/img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;display=swap'> -->
    <link rel='stylesheet' href='/style/ajax.css'>
    <link rel="stylesheet" href="/style/style.css">
</head>

<body>
    <div class="container">
        <h1>Internal Rating</h1><br>
        <hr>
        <p>What do you want to do?</p>

        <a href="/php/NewChildlayer.php"><button type="button">New player</button></a>
        <a href="/php/result.php"><button type="button">Report result</button></a>

        <br><hr><p>Tables:</p>
        <a href="/php/table.php"><button type="button">Rating table</button></a>
        <a href="/php/history.php"><button type="button">Game history</button></a>


        <br><hr><p>Beta features - Please use with caution:</p>
        <a href="/php/graph.php"><button type="button">Development</button></a>
        <a href="/php/sampleDB.php"><button type="button">Sample DB</button></a>
        
        <br><hr><p>Database - functions:</p>
        <a href="/php/reset.php"><button type="button">Delete database</button></a>
        <a href="/php/backup.php"><button type="button">Backup</button></a>


        <br><hr><p>Source Code:</p>
        <a href="/php/licence.php"><button type="button">License</button></a>
        <a href="https://github.com/eskopp/SimpleDWZ" target="_blank"><button type="button">Source code</button></a>
        <a href="https://github.com/eskopp/SimpleDWZ/issues/new/choose" target="_blank"><button type="button">Bug Report</button></a>
        <a href="https://github.com/eskopp/SimpleDWZ/archive/refs/heads/main.zip" target="_blank"><button type="button">Download</button></a>
        <a href="https://github.com/eskopp/SimpleDWZ/issues/" target="_blank"><button type="button">Known Bugs</button></a>
        <a href="https://github.com/eskopp/SimpleDWZ/releases/" target="_blank"><button type="button">Version 1.0.0</button></a>
        
    </div>
    <!-- partial:index.partial.html -->
    <?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
