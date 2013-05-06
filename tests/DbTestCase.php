<?php

namespace tests;

use Library\Db\Connection;

abstract class DbTestCase extends \PHPUnit_Framework_TestCase
{
    protected $connection;
    protected $dbConfig;

    public function setUp()
    {
        parent::setUp();

        $this->dbConfig = array('driver'   => 'sqlite',
                              'hostname' => '',
                              'dbname'   => ':memory:',
                              'user'     => '',
                              'password' => ''
        );

        $connection =  new Connection();
        $this->connection = $connection->getConnection($this->dbConfig);
    }

    protected function createTableAuthor()
    {
        return "CREATE TABLE author (
        id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        name VARCHAR(200) NOT NULL
        );";
    }

    protected function dropTableAuthor()
    {
        return "DROP TABLE author";
    }

    protected function createTableBook()
    {
        return "CREATE TABLE book (
        id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        title VARCHAR(200) NOT NULL,
        author INTEGER NOT NULL
        );";
    }

    protected function dropTableBook()
    {
        return "DROP TABLE book";
    }
}