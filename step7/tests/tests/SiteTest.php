<?php

//require __DIR__ . "/../../vendor/autoload.php";

class SiteTest extends \PHPUnit\Framework\TestCase
{
    public function testGettersSetters(){
        $site = new Felis\Site();
        $site->setEmail("testemail@testing.com");
        $this->assertEquals("testemail@testing.com", $site->getEmail());
        $site->setRoot("/root");
        $this->assertEquals("/root",$site->getRoot());
        $site->dbConfigure("host","user","pass","prefix");
        $this->assertEquals("prefix",$site->getTablePrefix());
    }
    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test_', $site->getTablePrefix());
    }
}