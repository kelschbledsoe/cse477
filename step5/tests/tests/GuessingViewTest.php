<?php
require __DIR__ . "/../../vendor/autoload.php";

class GuessingViewTest extends \PHPUnit\Framework\TestCase
{
    // Cheat mode seed. Answer is 23.
    const SEED = 1234;

    public function test_present(){
        $guessing = new Guessing\Guessing(self::SEED);
        $view = new Guessing\GuessingView($guessing);

        // Test start of game
        $present = $view->present();
        $this->assertContains('Try to guess the number',$present);

        // Test too low
        $guessing->guess(20);
        $present = $view->present();
        $this->assertContains('guesses you are',$present);
        $this->assertContains('too low',$present);
        $this->assertEquals($guessing->getGuess(), 20);
        $this->assertEquals($guessing->getNumGuesses(), 1);

        // Test too high
        $guessing->guess(25);
        $present = $view->present();
        $this->assertContains('guesses you are',$present);
        $this->assertContains('too high',$present);
        $this->assertEquals($guessing->getGuess(), 25);
        $this->assertEquals($guessing->getNumGuesses(), 2);

        // Test invalid
        $guessing->guess('a');
        $present = $view->present();
        $this->assertContains('Your guess',$present);
        $this->assertEquals($guessing->getGuess(), 'a');
        $this->assertEquals($guessing->getNumGuesses(), 2);

        $guessing->guess(200);
        $present = $view->present();
        $this->assertContains('Your guess',$present);
        $this->assertEquals($guessing->getGuess(), 200);
        $this->assertEquals($guessing->getNumGuesses(), 2);

        $guessing->guess(-5);
        $present = $view->present();
        $this->assertContains('Your guess',$present);
        $this->assertEquals($guessing->getGuess(), -5);
        $this->assertEquals($guessing->getNumGuesses(), 2);

        // Test correct
        $guessing->guess(23);
        $present = $view->present();
        $this->assertContains('guesses you are correct!',$present);
        $this->assertEquals($guessing->getGuess(), 23);
        $this->assertEquals($guessing->getNumGuesses(), 3);
    }
}