<?php


namespace Guessing;
use Guessing\Guessing as Guessing;
use Guessing\GuessingController as Controller;

class GuessingController
{
    public function __construct(Guessing $guessing, $post){
        $this->guessing = $guessing;
        if(isset($post['clear'])) {
            $this->reset = true;
        }
        if(isset($post['value'])){
            $post['value'] = strip_tags($post['value']);
            $this->guessing->guess($post['value']);
        }
    }

    public function isReset(){
        return $this->reset;
    }

    public function getGuessing(){
        return $this->guessing;
    }

    private $guessing;
    private $reset = false;
}