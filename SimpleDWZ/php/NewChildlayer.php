<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Rating</title>
    <link rel="icon" href="/img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/style/style.css">
    <script src="/js/Form_New_Child.js"></script>
</head>

<body>
    <div class="container">
        <h1>Internal rating</h1>
        <hr>
        <h2>Add new player:</h2>
        <form action="/php/NewChild.php" method="POST">
            <?php include __DIR__.'/FormNewChild.php'; ?>
        </form>
        <a href="index.php"><button type="button">Back</button></a><br>
    </div>
<!-- partial:index.partial.html -->
<?php include substr(__DIR__, 0, -3)."/php/particel.php"; ?>
</body>

</html>
