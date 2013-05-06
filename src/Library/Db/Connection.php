<?php

/**
 * Database connection
 *
 * PHP version 5.3.24
 *
 * @category Database
 * @package  Library
 * @author   Rodrigo dos Santos <email@rodrigodossantos.ws>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/rosantoz
 */

namespace Library\Db;

/**
 * Database connection
 *
 * @category Database
 * @package  Library
 * @author   Rodrigo dos Santos <email@rodrigodossantos.ws>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/rosantoz
 */
class Connection
{
    /**
     * Connects to the database
     *
     * @param array $config Connection params
     *
     * @return \PDO
     *
     * @throws \Exception
     */
    public function getConnection($config)
    {
        $dsn = $config['driver'] . ":host=" . $config['hostname'];
        $dsn .= ";dbname=" . $config['dbname'];
        try {
            return new \PDO($dsn, $config['user'], $config['password']);
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}