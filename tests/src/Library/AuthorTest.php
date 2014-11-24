<?php

namespace tests\Library;

use tests\DbTestCase;
use Library\Author;

class AuthorTest extends DbTestCase
{
    protected $author;

    public function setUp()
    {
        parent::setUp();
        $this->author = new Author($this->connection);
        $this->connection->exec($this->createTableAuthor());
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->connection->exec($this->dropTableAuthor());
    }

    public function testCanInsertAuthor()
    {
        $this->author->setName('Rodrigo');
        $result = $this->author->save();
        $this->assertEquals(1, $result);
    }

    public function testCanFindAuthor()
    {
        $this->author->setName('Rodrigo');
        $this->author->save();

        $find = $this->author->find(1);
        $this->assertEquals('Rodrigo', $find['name']);
    }

    public function testCanFetchAllAuthors()
    {
        $this->author->setName('Rodrigo');
        $this->author->save();

        $this->author->setName('Arthur');
        $this->author->save();

        $result = $this->author->fetchAll();

        $this->assertEquals(1, $result[0]['id']);
        $this->assertEquals('Rodrigo', $result[0]['name']);
        $this->assertEquals(2, $result[1]['id']);
        $this->assertEquals('Arthur', $result[1]['name']);
    }

    public function testCanUpdateAuthor()
    {
        $this->author->setName('Rodrigo');
        $this->author->save();

        $author = new Author($this->connection);
        $author->setId(1)
            ->setName('Rodrigo dos Santos');
        $author->save();

        $findAuthor = new Author($this->connection);
        $result     = $findAuthor->find(1);

        $this->assertEquals('Rodrigo dos Santos', $result['name']);

    }

    public function testCanDeleteAuthor()
    {
        $this->author->setName('Rodrigo');
        $result = $this->author->save();
        $this->author->delete($result);

        $findAuthor = new Author($this->connection);
        $result     = $findAuthor->find(1);

        $this->assertFalse($result);
    }

}