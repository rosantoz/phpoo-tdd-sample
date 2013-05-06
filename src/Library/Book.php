<?php

/**
 * Book Model
 *
 * PHP version 5.3.24
 *
 * @category Model
 * @package  Library
 * @author   Rodrigo dos Santos <email@rodrigodossantos.ws>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/rosantoz
 */

namespace Library;

/**
 * Book Model
 *
 * @category Model
 * @package  Library
 * @author   Rodrigo dos Santos <email@rodrigodossantos.ws>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/rosantoz
 */
class Book extends Base
{
    protected $table = 'book';
    protected $id;
    protected $title;
    protected $author;

    /**
     * Returns the book's id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Defines the book's id
     *
     * @param integer $id Book's Id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Defines the book's title
     *
     * @param string $title Book title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the book's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Defines the author's id
     *
     * @param integer $author Author's Id
     *
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Returns the author's id
     *
     * @return integer
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Insert a new book into the database
     *
     * @return integer Last inserted Id
     */
    public function insert()
    {
        $db  = $this->getDatabase();
        $sql = "INSERT INTO " . $this->getTable();
        $sql .= " (title, author) VALUES (:title, :author)";
        $stm = $db->prepare($sql);
        $stm->bindValue(':title', $this->getTitle());
        $stm->bindValue(':author', $this->getAuthor());
        $stm->execute();
        $stm->fetch(\PDO::FETCH_ASSOC);

        return $db->lastInsertId();
    }

    /**
     * Updates book data
     *
     * @return void
     */
    public function update()
    {
        $db  = $this->getDatabase();
        $sql = "UPDATE " . $this->getTable();
        $sql .= " SET title=:title, author=:author WHERE id=:id";
        $stm = $db->prepare($sql);
        $stm->bindValue(":id", $this->getId());
        $stm->bindValue(":title", $this->getTitle());
        $stm->bindValue(":author", $this->getAuthor());
        $stm->execute();
    }

}