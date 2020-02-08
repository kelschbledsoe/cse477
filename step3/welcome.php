<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Stalking the Wumpus</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<?php echo present_header("Stalking the Wumpus"); ?>
    <p><img class="center_pic" src="cave-evil-cat.png" width="530" height="287" alt="evilcat"/></p>
    <div id="welcome">
        <p> Welcome to </p>
    </div>
    <div id="notallowedtouseinlinecss">
        <p>Stalking the Wumpus</p>
    </div>

    <div class="bottom_options">
        <p><a href="instructions.php">Instructions</a></p>
    </div>
    <div class="start">
        <p><a href="game.php">Start Game</a></p>
    </div>
</body>
</html>