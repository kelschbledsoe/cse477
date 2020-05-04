<?php

namespace SuperLights;

class Game
{
    public function __construct($username=null){
        $this->username = $username;
    }

    /**
     * @return null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param null $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @return string
     */
    public function getCheck()
    {
        return $this->check;
    }

    /**
     * @param string $check
     */
    public function setCheck($check)
    {
        $this->check = $check;
    }

    public function getCellState($row, $col){
        return $this->board[$row][$col];
    }

    public function setCellState($state, $row, $col){
        $this->board[$row][$col] = $state;
    }

    public function getCheckStatesCell($row, $col){
        return $this->checkStates[$row][$col];
    }

    public function setCheckStatesCell($state, $row, $col){
        $this->checkStates[$row][$col] = $state;
    }

    public function resetCheckStates(){
        $this->checkStates = self::defaultStates;
        $this->check = "check";
    }

    /**
     * @return array
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return array
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @param array $board
     */
    public function setBoard($board)
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * @return array
     */
    public function getCheckStates()
    {
        return $this->checkStates;
    }

    // player name that's entered on index.php
    private $username;
    private $root = '/~kelschbl/exam';
    // variable for check button value
    private $check = "check";

    // consts for cell states
    const L = 'light';
    const UL = 'unlight';
    const US = 'unset';
    const W = 'wrong';
    const N = 'no check';

    // different game boards saved as private variables for convenience
    // what the board should look like at start
    private $start = [
        [self::US, self::US, self::US, self::US, 0, self::US, 0],
        [0, self::US, self::US, self::US, self::US, self::US, self::US],
        [self::US, 5, self::US, self::US, 2, self::US, self::US],
        [self::US, self::US, self::US, self::US, self::US, 5, self::US],
        [self::US, self::US, 2, self::US, self::US, 1, self::US],
        [5, self::US, self::US, self::US, self::US, self::US, 1],
        [self::US, self::US, self::US, self::US, 5, 5, self::US]
    ];
    // current game board
    private $board = [
        [self::US, self::US, self::US, self::US, 0, self::US, 0],
        [0, self::US, self::US, self::US, self::US, self::US, self::US],
        [self::US, 5, self::US, self::US, 2, self::US, self::US],
        [self::US, self::US, self::US, self::US, self::US, 5, self::US],
        [self::US, self::US, 2, self::US, self::US, 1, self::US],
        [5, self::US, self::US, self::US, self::US, self::US, 1],
        [self::US, self::US, self::US, self::US, 5, 5, self::US]
    ];
    // solution board
    private $solution = [
        [self::UL, self::L, self::UL, self::UL, 0, self::UL, 0],
        [0, self::UL, self::L, self::UL, self::UL, self::UL, self::UL],
        [self::UL, 5, self::UL, self::L, 2, self::L, self::UL],
        [self::L, self::UL, self::UL, self::UL, self::UL, 5, self::L],
        [self::UL, self::L, 2, self::UL, self::L, 1, self::UL],
        [5, self::UL, self::L, self::UL, self::UL, self::UL, 1],
        [self::L, self::UL, self::UL, self::UL, 5, 5, self::L]
    ];

    private $checkStates = [
        [self::N, self::N, self::N, self::N, 0, self::N, 0],
        [0, self::N, self::N, self::N, self::N, self::N, self::N],
        [self::N, 5, self::N, self::N, 2, self::N, self::N],
        [self::N, self::N, self::N, self::N, self::N, 5, self::N],
        [self::N, self::N, 2, self::N, self::N, 1, self::N],
        [5, self::N, self::N, self::N, self::N, self::N, 1],
        [self::N, self::N, self::N, self::N, 5, 5, self::N]
    ];

    // Saving table states as const for when need to reset checking highlight
    const defaultStates = [
        [self::N, self::N, self::N, self::N, 0, self::N, 0],
        [0, self::N, self::N, self::N, self::N, self::N, self::N],
        [self::N, 5, self::N, self::N, 2, self::N, self::N],
        [self::N, self::N, self::N, self::N, self::N, 5, self::N],
        [self::N, self::N, 2, self::N, self::N, 1, self::N],
        [5, self::N, self::N, self::N, self::N, self::N, 1],
        [self::N, self::N, self::N, self::N, 5, 5, self::N]
    ];
}