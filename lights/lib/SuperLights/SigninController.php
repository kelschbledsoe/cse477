<?php

namespace SuperLights;

class SigninController
{
    public function __construct(Game $game, $post){
        $this->game = $game;
        $this->post = $post;
        $root = $game->getRoot();

        if(!isset($post['name']) || empty($post['name'])){
            $this->setRedirect("$root/index.php");
        }
        else{
            $username = strip_tags($post['name']);
            $this->getGame()->setUsername($username);
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