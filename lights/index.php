<?php
require 'lib/superlights.inc.php';
$view = new SuperLights\SigninView($game);
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <?php echo $view->head()?>
</head>
<body>
<?php
echo $view->present();
?>
</body>
</html>