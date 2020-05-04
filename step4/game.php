<?php
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<header>
    <div class="options">
        <p><a href="welcome.php">New Game</a>
        <a href="game.php">Game</a>
        <a href="instructions.php">Instructions</a>
        </p>
    </div>
    <h1>Stalking the Wumpus</h1>
</header>
    <p><img class="center_pic" src="cave.jpg" width="600" height="325" alt="centerpic"/></p>
    <?php
    echo $view->presentStatus();
    ?>
    <div class="rooms">
        <div class="rooms">
            <?php
            echo $view->presentRoom(0);
            echo $view->presentRoom(1);
            echo $view->presentRoom(2);
            ?>
        </div>
    </div>
    <div id="inventory">
        <?php
        echo $view->presentArrows();
        ?>
    </div>
</body>
</html>