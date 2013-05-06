<?php

namespace tests\Library;


use tests\DbTestCase;
use Library\Book;

class BookTest extends DbTestCase
{
    protected $book;

    public function setUp()
    {
        parent::setUp();
        $this->book = new Book($this->connection);
        $this->connection->exec($this->createTableBook());
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->connection->exec($this->dropTableBook());
    }

    public function testCanInsertBook()
    {
        $this->book->setTitle('Lord of The Rings')
            ->setAuthor(1);
        $result = $this->book->save();
        $this->assertEquals(1, $result);
    }

    public function testCanFindBook()
    {
        $this->book->setTitle('The Stalker')
            ->setAuthor(2);
        $this->book->save();

        $find = $this->book->find(1);
        $this->assertEquals('The Stalker', $find['title']);
    }

    public function testCanFetchAllBooks()
    {
        $this->book->setTitle('Lord of The Rings')
            ->setAuthor(1);
        $this->book->save();

        $this->book->setTitle('King Arthur')
            ->setAuthor(2);
        $this->book->save();

        $result = $this->book->fetchAll();

        $this->assertEquals(1, $result[0]['id']);
        $this->assertEquals('Lord of The Rings', $result[0]['title']);
        $this->assertEquals(2, $result[1]['id']);
        $this->assertEquals('King Arthur', $result[1]['title']);
    }

        public function testCanUpdateBook()
        {
            $this->book->setTitle('King Arthur')
                ->setAuthor(1);
            $this->book->save();

            $book = new Book($this->connection);
            $book->setId(1)
                ->setTitle('King Arthur 2')
                ->setAuthor(2);
            $book->save();

            $findBook = new Book($this->connection);
            $result     = $findBook->find(1);

            $this->assertEquals('King Arthur 2', $result['title']);
            $this->assertEquals(2, $result['author']);

        }


        public function testCanDeleteBook()
        {
            $this->book->setTitle('Lord of The Rings')
                ->setAuthor(1);
            $result = $this->book->save();
            $this->book->delete($result);

            $findBook = new Book($this->connection);
            $result     = $findBook->find(1);

            $this->assertFalse($result);
        }

}