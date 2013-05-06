<?php

/**
 * Abstract Base Model
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
 * Abstract Base Model
 *
 * @category Model
 * @package  Library
 * @author   Rodrigo dos Santos <email@rodrigodossantos.ws>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/rosantoz
 */
abstract class Base
{
    protected $database;
    protected $table;

    /**
     * Class construction. Registers the class dependencies
     *
     * @param \PDO $database PDO connection
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Returns the PDO connection
     *
     * @return \PDO
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Returns the table name
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Save or update a record
     *
     * @return mixed
     */
    public function save()
    {
        if ($this->id) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    /**
     * Find a record by Id
     *
     * @param integer $id Id
     *
     * @return mixed
     */
    public function find($id)
    {
        $db  = $this->getDatabase();
        $stm = $db->prepare("SELECT * FROM " . $this->getTable() . " WHERE id=:id");
        $stm->bindValue(":id", $id);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves all records from the table
     *
     * @return array
     */
    public function fetchAll()
    {
        $db  = $this->getDatabase();
        $stm = $db->prepare("SELECT * FROM " . $this->getTable() . "");
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Deletes an record from the database
     *
     * @param integer $id Id to be deleted
     *
     * @return void
     */
    public function delete($id)
    {
        $db  = $this->getDatabase();
        $stm = $db->prepare("DELETE FROM " . $this->table . " WHERE id=:id ");
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    /**
     * Insert model data into the database
     *
     * @return mixed
     */
    abstract function insert();

    /**
     * Update model data
     *
     * @return mixed
     */
    abstract function update();
}