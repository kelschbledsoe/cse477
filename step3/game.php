<?php
require 'format.inc.php';
require 'wumpus.inc.php';
$room = 1; // The room we are in.
$cave = cave_array(); // Get the cave
$birds = 7;  // Room with the birds
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
$wumpus = 16; // The wumpus
if(isset($_GET['r']) && isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
}
?>
<?php
// Birds place you in room 10
if($room == $birds){
    $room = 10;
}
// Check if in room with bottomless pit or with the wumpus
if(in_array($room,$pits) || $room == $wumpus){
    header("Location: lose.php");
    exit;
}

// Shoot an arrow
// a flag signifies which room shooting into
if(isset($_GET['a'])){
    // a flag is an int
    if(is_int((int)$_GET['a'])){
        // a flag is a valid int
        if($_GET['a']>0 && $_GET['a']<=$cave[count($cave)]){
            // if this is actually a room you can shoot into
            if(in_array($_GET['a'], $cave[$room])){
                $room_shot = $_GET['a'];
                // if you shoot the wumpus, you win!
                if($room_shot == $wumpus){
                    header("Location: win.php");
                    exit;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<?php echo present_header("Stalking the Wumpus"); ?>
    <p><img class="center_pic" src="cave.jpg" width="600" height="325" alt="centerpic"/></p>
    <div id="description">
        <?php
        echo '<p>' . date("g:ia l, F j, Y") . '</p>';
        ?>
        <p>You are in room <?php echo $room; ?></p>
    </div>
    <?php
    // If within 1 room of the birds
    if($cave[$room][0] === $birds || $cave[$room][1] === $birds || $cave[$room][2] === $birds){
        echo "<div id='story'><p>You hear birds!</p></div>";
    }
    else{
        echo "<p>&nbsp;</p>";
    }
    // If within 1 room of a bottomless pit
    if(in_array($cave[$room][0],$pits) || in_array($cave[$room][1],$pits) || in_array($cave[$room][2],$pits)){
        echo "<div id='story'><p>You feel a draft!</p></div>";
    }
    else{
        echo "<p>&nbsp;</p>";
    }
    // If within 2 rooms of the wumpus
    $wumpus_nearby = 0;
    // Check the rooms 1 space from the current
    for($i=0; $i<count($cave[$room]); $i++){
        if($cave[$room][$i] == $wumpus) {
            echo "<div id='story'><p>You smell a wumpus!</p></div>";
            $wumpus_nearby = 1;
            break;
        }
        // Check the room 2 spaces from the current, so the neighbors of the neighbor
        for($j=0; $j<count($cave[$cave[$room][$i]]); $j++){
            if($cave[$cave[$room][$i]][$j] == $wumpus){
                echo "<div id='story'><p>You smell a wumpus!</p></div>";
                $wumpus_nearby = 1;
                break;
            }
        }
    }
    if($wumpus_nearby == 0){
        echo "<p>&nbsp;</p>";
    }
    ?>
    <div class="rooms">
        <div class="room"><img src="cave2.jpg" width="180" height="135" alt="cave2">
            <p><a href="game.php?r=<?php echo $cave[$room][0]; ?>"><?php echo $cave[$room][0]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room ?>&a=<?php echo $cave[$room][0]; ?>">Shoot Arrow</a></p>
        </div>
        <div class="room"><img src="cave2.jpg" width="180" height="135" alt="cave2">
            <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>"><?php echo $cave[$room][1]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room ?>&a=<?php echo $cave[$room][1]; ?>">Shoot Arrow</a></p>
        </div>
        <div class="room"><img src="cave2.jpg" width="180" height="135" alt="cave2">
            <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>"><?php echo $cave[$room][2]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room ?>&a=<?php echo $cave[$room][2]; ?>">Shoot Arrow</a></p>
        </div>
    </div>
    <div id="inventory">
        <p>You have 3 arrows remaining.</p>
    </div>
</body>
</html>