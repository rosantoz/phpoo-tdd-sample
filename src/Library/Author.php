<?php

/**
 * Author Model
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
 * Author Model
 *
 * @category Model
 * @package  Library
 * @author   Rodrigo dos Santos <email@rodrigodossantos.ws>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/rosantoz
 */
class Author extends Base
{

    protected $table = 'author';
    protected $id;
    protected $name;

    /**
     * Returns the author's Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Defines the author's Id
     *
     * @param integer $id Id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Defines the author's name
     *
     * @param string $name Name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the author's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Insert a new author into the database
     *
     * @return integer Last inserted Id
     */
    public function insert()
    {
        $db  = $this->getDatabase();
        $sql = "INSERT INTO " . $this->getTable() . " (name) VALUES (:name)";
        $stm = $db->prepare($sql);
        $stm->bindValue(':name', $this->getName());
        $stm->execute();
        $stm->fetch(\PDO::FETCH_ASSOC);

        return $db->lastInsertId();
    }

    /**
     * Updates author data
     *
     * @return void
     */
    public function update()
    {
        $db  = $this->getDatabase();
        $sql = "UPDATE " . $this->getTable() . " SET name=:name WHERE id=:id";
        $stm = $db->prepare($sql);
        $stm->bindValue(":id", $this->getId());
        $stm->bindValue(":name", $this->getName());
        $stm->execute();
    }
}
