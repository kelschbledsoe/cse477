<?php

namespace SuperLights;

class SigninView
{
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function getGame()
    {
        return $this->game;
    }

    public function present()
    {
        $html = '';

        $html .= <<<HTML
<form id="signin" method="post" action="post/signin-post.php">
    <fieldset>
        <p><img src="img/banner.png" width="521" height="346" alt="Super Lights Banner"></p>
        <p>Welcome to Super Lights</p>
        <p><label for="name">Your Name: </label>
            <input type="text" name="name" id="name"></p>
        <p><input type="submit" value="Start Game"></p>
    </fieldset>
</form>
HTML;

        return $html;
    }

    public function head(){
        $html = '';
        $html .= <<<HTML
<meta charset="UTF-8">
    <title>Super Lights Signin</title>
    <link href="lights.css" type="text/css" rel="stylesheet" />
HTML;
        return $html;
    }

    private $game;
}