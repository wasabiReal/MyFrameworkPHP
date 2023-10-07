<?php

/**
 * @var $errornum ErrorHandler
 * @var $errorstr ErrorHandler
 * @var $errorfile ErrorHandler
 * @var $errorline ErrorHandler
 */

use wsb\ErrorHandler;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dev Errors</title>
    <style>
        .errors {
            width: 80%;
            margin: auto;
            background: #eeeeee;
            padding: 20px;
            border-style: inset;
        }
    </style>
</head>
<body>
<div class="errors">
    <h1>Detected error</h1>
    <p><b>Error code:</b> <?= $errornum ?></p>
    <p><b>Text error:</b> <?= $errorstr ?></p>
    <p><b>File:</b> <?= $errorfile ?></p>
    <p><b>Error string: </b><?= $errorline ?></p>
</div>
</body>
</html>