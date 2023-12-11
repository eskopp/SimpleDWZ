<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Rating</title>
    <link rel="icon" href="/img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="container">
        <h1>Internal Rating</h1><br>
        <hr>
        <p>Load Backup</p><br><br>
        The tool only reads the data. The data is not tested for correctness or redunancy. <br><br>
        <form action="enter_runner.php" method="post">
            <label for="User">User:</label><br>
            <textarea name="user" rows="5" cols="40"></textarea><br>
            <br>
            <label for="Table">Table:</label><br>
            <textarea name="table" rows="5" cols="40"></textarea><br>
            <br>
            <label for="History">History:</label><br>
            <textarea name="history" rows="5" cols="40"></textarea><br>
            <br>
            <label class="switch" for="toggleBackup">
                <input type="checkbox" id="toggleBackup" name="backup">
                <span class="slider"></span>
                <span class="slider-text">OFF</span>
            </label>   I guarantee that the data is correct.

            <button type="submit">Load Backup</button>
        </form>



    
    </div>

    <?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
