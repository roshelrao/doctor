<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="libCSS\main.css">
    <title>Document</title>
</head>
<body>
<center>
    <h1 style="padding:5%; margin:5%; transition: none; transform:scale(1);">
    <?php
    $obj = new clinic();

    $obj->error();
    ?>
    </h1>

    <button onclick="window.history.back();">Go back</button>
</center>
</body>
</html>