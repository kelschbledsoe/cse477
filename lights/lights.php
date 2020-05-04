<?php
require 'lib/superlights.inc.php';
$view = new SuperLights\LightsView($game);
?>
<!doctype html>
<html>
<head>
    <?php echo $view->head()?>
</head>

<body>

<form id="gameform" method="post" action="post/lights-post.php">
    <fieldset>
        <?php
        echo $view->presentName();
        echo $view->presentGameBoard();
        echo $view->presentFooter();
        ?>
    </fieldset>
</form>


</body>
</html>