<?php


namespace SuperLights;


class LightsView
{
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function getGame()
    {
        return $this->game;
    }

    public function presentName(){
        // show player's name correctly at top of page
        $html = "<p>".$this->getGame()->getUsername()."'s Super Lights</p>";
        return $html;
    }

    public function head(){
        $html = '';
        $html .= <<<HTML
<meta charset="utf-8">
    <link href="lights.css" type="text/css" rel="stylesheet" />
    <title>Super Lights</title>
HTML;
        return $html;
    }

    public function presentGameBoard(){
        // gameboard from starter code
        $values = [
            [-1, -1, -1, -1, 0, -1, 0],
            [0, -1, -1, -1, -1, -1, -1],
            [-1, 5, -1, -1, 2, -1, -1],
            [-1, -1, -1, -1, -1, 5, -1],
            [-1, -1, 2, -1, -1, 1, -1],
            [5, -1, -1, -1, -1, -1, 1],
            [-1, -1, -1, -1, 5, 5, -1]
        ];

        $html = '<table>';

        for($r=0; $r<count($values); $r++) {
            $html .= '<tr>';
            $row = $values[$r];
            for($c=0; $c<count($row); $c++) {
                $value = $values[$r][$c];
                if($value < 0) {
                    // cell is a light
                    if($this->getGame()->getCellState($r,$c) === Game::L){
                        // wrong light, make cell highlighted
                        if($this->getGame()->getCheckStatesCell($r,$c) === Game::W){
                            $html .= '<td class="light wrong">
                                        <button name="cell" value="'.$r . ',' .$c .'">
                                            <img src="img/light.png" width="43" height="75">
                                        </button>
                                      </td>';
                        }
                        // light is correct, don't highlight
                        else{
                            $html .= '<td class="light">
                                        <button name="cell" value="'.$r . ',' .$c .'">
                                            <img src="img/light.png" width="43" height="75">
                                        </button>
                                      </td>';
                        }
                    }
                    // cell is unlight
                    else if($this->getGame()->getCellState($r,$c) === Game::UL){
                        // wrong, make cell highlighted
                        if($this->getGame()->getCheckStatesCell($r,$c) === Game::W){
                            $html .= '<td class="unshaded wrong">
                                        <button name="cell" value="'.$r . ',' .$c .'">
                                            &bull;
                                        </button>
                                      </td>';
                        }
                        // correct, don't highlight
                        else{
                            $html .= '<td class="unshaded">
                                        <button name="cell" value="'.$r . ',' .$c .'">
                                            &bull;
                                        </button>
                                      </td>';
                        }
                    }
                    // empty cell
                    else{
                        $html .= '<td><button name="cell" value="'.$r . ',' .$c .'">&nbsp;</button></td>';
                    }

                } else if($value > 4) {
                    $html .= '<td class="wall">&nbsp;</td>';
                } else {
                    $html .= '<td class="wall">' . $value . '</td>';
                }
            }

            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }

    public function presentFooter(){
        // adding logic for once win game (either give up or correctly complete the game
        // since winning the game just modifies what the footer looks like
        $win = true;
        $values = [
            [-1, -1, -1, -1, 0, -1, 0],
            [0, -1, -1, -1, -1, -1, -1],
            [-1, 5, -1, -1, 2, -1, -1],
            [-1, -1, -1, -1, -1, 5, -1],
            [-1, -1, 2, -1, -1, 1, -1],
            [5, -1, -1, -1, -1, -1, 1],
            [-1, -1, -1, -1, 5, 5, -1]
        ];
        while($win){
            for($r=0; $r<count($values); $r++) {
                $row = $values[$r];
                for ($c = 0; $c < count($row); $c++) {
                    $value = $values[$r][$c];
                    if ($value < 0) {
                        // if this cell should be a light but isn't, not a win
                        if($this->getGame()->getSolution()[$r][$c] === Game::L){
                            if($this->getGame()->getCellState($r,$c) !== Game::L){
                                $win = false;
                            }
                        }
                        else if($this->getGame()->getSolution()[$r][$c] !== Game::L){
                            if($this->getGame()->getCellState($r,$c) === Game::L){
                                $win = false;
                            }
                        }
                    }
                }
            }
            break;
        }

        if($win){
            $html = <<<HTML
<p>Solution is correct!</p>
<p><input type="submit" name="newgame" value="New Game"></p>
<p><a href="post/logout.php">Goodbye!</a></p>
HTML;
            return $html;
        }

        // handle check button logic
        if($this->getGame()->getCheck() === "check"){
            $html = '<p><input type="submit" name="check" value="Check"></p>';
        }
        else{
            $html = '<p><input type="submit" name="check" value="Uncheck"></p>';
        }

        // other buttons in footer
        $html .= <<<HTML
<p><input type="submit" name="giveup" value="Give Up"></p>
<p><input type="submit" name="newgame" value="New Game"></p>
<p><a href="post/logout.php">Goodbye!</a></p>
HTML;
        return $html;
    }

    private $game;
}