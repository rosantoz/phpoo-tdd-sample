<?php

namespace tests\Library\Db;

use Library\Db\Connection;
use tests\DbTestCase;

class ConnectionTest extends DbTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testConnectionInstance()
    {
        $connection = new Connection;
        $this->assertInstanceOf('\Library\Db\Connection', $connection);
    }

    public function testMustReturnAPdoObject()
    {
        $connection = new Connection;
        $con        = $connection->getConnection($this->dbConfig);
        $this->assertInstanceOf('\PDO', $con);
    }

    public function testConnection()
    {
        $connection = new Connection();
        try {
            $con = $connection->getConnection($this->dbConfig);
            $con->query("show tables");
        } catch (\PDOException $e) {
            $this->fail($e->getMessage());
        }

    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage could not find driver
     */
    public function testConnectionException()
    {
        $config     = array (
            'driver' => '1234',
            'hostname' => 'idontknow',
            'dbname' => 'idontknow',
            'user' => 'idontknow',
            'password' => '123123'
        );
        $connection = new Connection();
        $connection->getConnection($config);
    }


}