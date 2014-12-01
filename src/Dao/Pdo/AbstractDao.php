<?php

namespace Bird\Dao\Pdo;

/**
 * Abstract class for pdo daos.
 *
 * @author kemal
 */
abstract class AbstractDao {

    private $connection;

    /**
     * Finds entity by id.
     *
     * @author kemal
     * @param $id
     */
    public abstract function findById($id);

    /**
     * Returns a PDO connection.
     *
     * @throws \PDOException
     * @return \PDO
     */
    protected function getConnection() {
        if (! empty($this->connection)) {
            return $this->connection;
        }

        $user = 'root';
        $pw = '';
        try {
            $this->connection = new \PDO('mysql:host=localhost;dbname=bird', $user, $pw);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
        return $this->connection;
    }

    /**
     * Closes the connection.
     *
     * @author kemal
     * @return void
     */
    protected function closeConnection() {
        $this->connection = null;
    }
}