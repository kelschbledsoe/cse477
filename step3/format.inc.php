<?php
/**
 * Create the HTML for the header block
 * @param $title The page title
 * @return string HTML for the header block
 */
function present_header($title) {
    $html = "<header>";
    $html .= "<div class=\"options\">";
    $html .= "<nav><p><a href=\"welcome.php\">New Game</a> ";
    $html .= "<a href=\"game.php\">Game</a> ";
    $html .= "<a href=\"instructions.php\">Instructions</a></p></nav>";
    $html .= "<h1>$title</h1>";
    $html .= "</header>";

    return $html;
}