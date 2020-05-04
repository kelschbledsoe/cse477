<?php
require __DIR__ . "/../../vendor/autoload.php";

// This allows us to use just Guessing
// instead of Guessing\Guessing
use Guessing\Guessing as Guessing;
use Guessing\GuessingController as Controller;

/** @file
 * Unit tests for the class Guessing
 */
class GuessingControllerTest extends \PHPUnit\Framework\TestCase {
    const SEED = 1234;

    public function test_reset() {
        $guessing = new Guessing(self::SEED);
        $controller = new Controller($guessing, array('value' => 12));
        $this->assertFalse($controller->isReset());
        $this->assertEquals(12,$controller->getGuessing()->getGuess());
        $this->assertEquals(23,$controller->getGuessing()->getNumber());

        $guessing = new Guessing(self::SEED);
        $controller = new Controller($guessing, array('clear' => 'New Game'));
        $this->assertTrue($controller->isReset());
    }

}