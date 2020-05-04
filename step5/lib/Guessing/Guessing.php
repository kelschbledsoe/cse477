<?php


namespace Guessing;


class Guessing
{
    const MIN = 1;
    const MAX = 100;
    const INVALID = -10;
    const TOOLOW = -21;
    const TOOHIGH = 31;
    const CORRECT = -41;
    const VACANT = -51;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    public function getNumber(){
        return $this->number;
    }

    public function getNumGuesses(){
        return $this->numGuesses;
    }

    public function getGuess(){
        return $this->guess;
    }

    public function guess($num){
        $this->guess = $num;
    }

    public function check(){
        // Check for invalid input
        if(($this->guess > self::MAX || $this->guess < self::MIN || !is_numeric($this->guess)) && $this->guess != self::VACANT) {
            return self::INVALID;
        }
        else if($this->guess == self::VACANT){
            return self::VACANT;
        }
        // Valid guess, determine if too high, low, or correct
        else{
            $this->numGuesses++;
            if($this->guess > $this->number){
                return self::TOOHIGH;
            }
            else if($this->guess < $this->number){
                return self::TOOLOW;
            }
            else{
                return self::CORRECT;
            }
        }
    }
    private $number;
    private $numGuesses = 0;
    private $guess = self::VACANT;
}