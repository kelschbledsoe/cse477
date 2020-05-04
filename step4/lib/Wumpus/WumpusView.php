<?php


namespace Wumpus;


class WumpusView
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     */
    public function __construct(Wumpus $wumpus) {
        $this->wumpus = $wumpus;
    }

    /**
     * Generate the HTML for the number of arrows remaining
     * @return string HTML
     */
    public function presentArrows() {
        $a = $this->wumpus->numArrows();
        return "<p>You have $a arrows remaining.</p>";
    }

    /**
     * Generate the HTML for the status section of the page
     */
    public function presentStatus() {
        $html = "";
        $room = $this->wumpus->getCurrent()->getNum();
        $html .= "<div id='description'><p>You are in room $room</p></div>";
        // Logic for formatting and displaying the proper HTML depending on which room you're in
        $usedStoryDiv = false;
        if($this->wumpus->wasCarried()){
            $html .= "<div id='story'><p>You were carried by the birds to room " . $this->wumpus->getCurrent()->getNum() . "!</p></div>";
        }
        if($this->wumpus->hearBirds()){
            $html .= "<div id='story'><p>You hear birds!</p>";
            $usedStoryDiv = true;
        }
        if($this->wumpus->feelDraft()){
            if($usedStoryDiv == false){
                $html .= "<div id='story'><p>You feel a draft!</p>";
            }
            else{
                $html .= "<p>You feel a draft!</p>";
            }
            $usedStoryDiv = true;
        }
        if($this->wumpus->smellWumpus()){
            if($usedStoryDiv == false) {
                $html .= "<div id='story'><p>You smell a wumpus!</p>";
            }
            else{
                $html .= "<p>You smell a wumpus!</p>";
            }
            $usedStoryDiv = true;
        }
        if ($usedStoryDiv){
            $html .= "</div>";
        }

        return $html;
    }

    /**
     * Present the links for a room
     * @param int $ndx An index 0 to 2 for the three rooms
     * @return string HTML
     */
    public function presentRoom($ndx) {
        $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];
        $roomnum = $room->getNum();
        $roomndx = $room->getNdx();
        $roomurl = "game-post.php?m=$roomndx";
        $shooturl = "game-post.php?s=$roomndx";

        $html = <<<HTML
<div class="room">
  <figure><img src="cave2.jpg" width="180" height="135" alt=""/></figure>
  <p><a href="$roomurl">$roomnum</a></p>
<p><a href="$shooturl">Shoot Arrow</a></p>
</div>
HTML;

        return $html;
    }

    private $wumpus;    // The Wumpus object
}