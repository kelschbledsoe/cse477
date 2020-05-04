<?php


namespace SuperLights;


class LightsController
{
    public function __construct(Game $game, $post){
        /*phpinfo();*/
        $this->game = $game;
        $this->post = $post;
        $root = $game->getRoot();
        $game->resetCheckStates();
        // Handle all the logic for clicking anything on lights.php
        // Clicked on a cell
        if(isset($post['cell'])){
            /*You can use the PHP explode function to get the two values from this string*/
            $vals = explode(',',$post['cell']);

            // Set the new cell states!
            // cell is unset, now make light
            if ($game->getCellState($vals[0], $vals[1]) === Game::US){
                $game->setCellState(Game::L, $vals[0], $vals[1]);
            }
            // cell was light, now make unlight
            else if ($game->getCellState($vals[0], $vals[1]) === Game::L){
                $game->setCellState(Game::UL, $vals[0], $vals[1]);
            }
            // cell was unlight, now make unset
            else{
                $game->setCellState(Game::US, $vals[0], $vals[1]);
            }
            $this->setRedirect("$root/lights.php");
        }
        // clicked on check button
        else if(isset($post['check'])){
            // values from footer html
            if($post['check'] === 'Check'){
                // loop over board
                for($r=0; $r<count($game->getBoard()); $r++){
                    $row = $game->getBoard()[$r];
                    for($c = 0; $c<count($row); $c++){
                        // if cell not correct, set state to wrong
                        if($game->getCellState($r, $c) !== Game::US){
                            if($game->getCellState($r, $c) !== $game->getSolution()[$r][$c]){
                                $game->setCheckStatesCell(Game::W, $r, $c);
                            }
                        }
                    }
                }
                $game->setCheck("uncheck");
            }
            else if($post['check'] === 'Uncheck'){
                // loop over board
                for($r = 0; $r<count($game->getCheckStates()); $r++){
                    $row = $game->getCheckStates()[$r];
                    for($c=0; $c<count($row); $c++){
                        // reset wrong cells to no check so not highlighted
                        if($game->getCheckStatesCell($r, $c) === Game::W){
                            $game->setCheckStatesCell(Game::N, $r, $c);
                        }
                    }
                }
                $game->setCheck("check");
            }
            $this->setRedirect("$root/lights.php");
        }
        // clicked on new game
        else if(isset($post['newgame'])){
            $game->setBoard($game->getStart());
            $this->setRedirect("$root/lights.php");
        }
        // clicked on give up
        else if(isset($post['giveup'])){
            $game->setBoard($game->getSolution());
            $this->setRedirect("$root/lights.php");
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }


    private $redirect;
    private $game;
    private $post;
}