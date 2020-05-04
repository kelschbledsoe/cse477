<?php


namespace Wumpus;


class WumpusController
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     * @param array $get The $_GET array
     */
    public function __construct(Wumpus $wumpus, $get) {
        $this->wumpus = $wumpus;
        if(isset($get['m'])) {
            $this->move($get['m']);
        } else if(isset($get['s'])) {
            $this->shoot($get['s']);
        } else if(isset($get['n'])) {
            // New game!
            $this->reset = true;
        }
        // Cheat mode!
        else if(isset($request['c'])){
            $this->reset = true;
            $_REQUEST['c'] = 1;
        }
    }

    public function getPage(){
        return $this->page;
    }

    public function isReset(){
        return $this->reset;
    }

    /**
     * Move request
     * @param int $ndx Index for room to move to
     */
    private function move($ndx){
        // Simple error check
        if (!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        switch ($this->wumpus->move($ndx)) {
            case Wumpus::HAPPY:
                break;

            case Wumpus::EATEN:
            case Wumpus::FELL:
                $this->reset = true;
                $this->page = 'lose.php';
                break;
        }
    }

    /**
     * Shoot request
     * @param int $ndx Index for room to shoot into
     */
    private function shoot($ndx) {
        // Simple error check
        if (!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }
        $shot = $this->wumpus->shoot($ndx);

        if($shot){
            $this->reset = true;
            $this->page = 'win.php';
        }
        // Run out of arrows means you lose
        if ($this->wumpus->numArrows() == 0){
            $this->page = 'lose.php';
        }
    }

    private $wumpus;                // The Wumpus object we are controlling
    private $page = 'game.php';     // The next page we will go to
    private $reset = false;         // True if we need to reset the game
}