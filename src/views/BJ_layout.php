<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/css/app.css">
    <title>Black Jack Game</title>
</head>
<body>
<h1>Black Jack Game!!!</h1>
<?php
    require_once('BJGame.php');

    $game = new BJGame();
    $game->start();
?>
<div class="container">
    <?php include $content; ?>
</div>

<!-- <form method="POST">
    <label for="yes">Yes</label>
    <input type="radio" name="yesOrNo" id="yes" value="Y" required>

    <label for="no">No</label>
    <input type="radio" name="yesOrNo" id="no" value="N" required>

    <button type="submit">Submit</button>
</form> -->


</body>
</html>
