<?php
require __DIR__ . "/../../vendor/autoload.php";

class UsersTest extends \PHPUnit\Framework\TestCase
{

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_pdo() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('\PDO', $users->pdo());
    }

    protected function setUp() {
        $users = new Felis\Users(self::$site);
        $tableName = $users->getTableName();

        $sql = <<<SQL
delete from $tableName;
insert into $tableName(id, email, name, phone, address, 
                      notes, password, joined, role)
values (7, "dudess@dude.com", "Dudess, The", "111-222-3333", 
        "Dudess Address", "Dudess Notes", "87654321", 
        "2015-01-22 23:50:26", "S"),
        (8, "cbowen@cse.msu.edu", "Owen, Charles", "999-999-9999", 
        "Owen Address", "Owen Notes", "super477", 
        "2015-01-01 23:50:26", "A"),
        (9, "bart@bartman.com", "Simpson, Bart", "999-999-9999", 
        "", "", "bart477", "2015-02-01 01:50:26", "C"),
        (10, "marge@bartman.com", "Simpson, Marge", "", "",
        "", "marge", "2015-02-01 01:50:26", "C")
SQL;

        self::$site->pdo()->query($sql);
    }

    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals(7, $user->getId());
        $this->assertEquals('dudess@dude.com',$user->getEmail());
        $this->assertEquals('Dudess, The', $user->getName());
        $this->assertEquals('111-222-3333',$user->getPhone());
        $this->assertEquals('Dudess Address', $user->getAddress());
        $this->assertEquals('Dudess Notes', $user->getNotes());

        $datetime = new DateTime();
        $datetime->setDate(2015,01,22);
        $datetime->setTime(23,50,26);

        $this->assertEquals($datetime->getTimestamp(), $user->getJoined());
        $this->assertEquals('S', $user->getRole());
        $this->assertEquals(true, $user->isStaff());

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);
    }

    public function test_get(){
        $users = new Felis\Users(self::$site);
        $user = $users->get(7);
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals(7, $user->getId());
        $this->assertEquals('dudess@dude.com',$user->getEmail());
        $this->assertEquals('Dudess, The', $user->getName());
        $this->assertEquals('111-222-3333',$user->getPhone());
        $this->assertEquals('Dudess Address', $user->getAddress());
        $this->assertEquals('Dudess Notes', $user->getNotes());

        $datetime = new DateTime();
        $datetime->setDate(2015,01,22);
        $datetime->setTime(23,50,26);

        $this->assertEquals($datetime->getTimestamp(), $user->getJoined());
        $this->assertEquals('S', $user->getRole());
        $this->assertEquals(true, $user->isStaff());
    }

    public function test_update(){
        $users = new Felis\Users(self::$site);
        $user = $users->get(9);
        $user->setEmail("peter.parker@dailybugle.com");
        $user->setName("Peter Parker");
        $user->setAddress("Queens, NYC");
        $user->setNotes("With great power comes great responsibility");
        $user->setPhone("123-456-7890");
        $user->setRole("U");
        $this->assertTrue($users->update($user));

        $row = array(
            'id'=>6969,
            'email'=>"DoctorOctopus@Oscorp.com",
            'name'=>"Doctor Octopus",
            'address'=>'',
            'phone'=>"098-765-4321",
            'notes'=>"Sinister Six",
            'joined'=>'',
            'role'=>"F"
        );
        $user = new Felis\User($row);
        $this->assertFalse($users->update($user));
        $user = $users->get(9);
        $user->setEmail("mary.j@dailybugle.com");
        $this->assertTrue($users->update($user));
    }

    private static $pdo = null; // The PDO object
}