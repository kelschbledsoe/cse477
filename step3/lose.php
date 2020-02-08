<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lose Page</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<?php echo present_header("Stalking the Wumpus"); ?>

    <p><img class="center_pic" src="wumpus-wins.jpg" width="600" height="325" alt="wumpuswins"/></p>
    <div id="result">
        <p>You died and the Wumpus ate your brain!</p>
    </div>

    <div class="bottom_options">
        <p><a href="welcome.php">New Game</a></p>
    </div>

</body>
</html>