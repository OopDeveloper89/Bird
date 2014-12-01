<?php

/**
 * Created by PhpStorm.
 * User: kemal
 * Date: 30.11.2014
 * Time: 14:44
 */
class UserDaoTest extends PHPUnit_Framework_TestCase {

    /**
     *
     */
    public function testFindById() {
        require_once __DIR__ . '/../vendor/autoload.php';

        $dao = new \Bird\Dao\Pdo\UserDao();
        $user = $dao->findById(1);
        var_dump($user);
        $this->assertEquals('hallo', 'hallo');
    }

}
 