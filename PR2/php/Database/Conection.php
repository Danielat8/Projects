<?php


class Connection
{
    private $mysql;
    private $localhost;
    private $dbName;
    private $port;
    private $username;
    private $password;
    private $connection;

    public function __construct($mysql, $localhost, $dbName, $port, $username, $password)
    {

        $this->setMySql($mysql);
        $this->setLocalHost($localhost);
        $this->setNameAboutDb($dbName);
        $this->setPort($port);
        $this->setUsername($username);
        $this->setPassword($password);
    }
    public function Connection()
    {
        $mysql = $this->getMySql();
        $localhost = $this->getLocalHost();
        $dbName = $this->getNameAboutDb();
        $port = $this->getPort();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $connection = $this->getConnection();

        try {
            $connection = new PDO("$mysql:host=$localhost;dbname=$dbName;port=$port=4306", $username, $password);
            $this->setConnection($connection);
        } catch (PDOException $err) {
            echo $err->getMessage();
            die();
        }
    }
    /**
     * Get the value of mysql
     */
    public function getMySql()
    {
        return $this->mysql;
    }
    /**
     * Set the value of mysql
     *
     * @return  self
     */

    public function setMySql($mysql)
    {
        $this->mysql = $mysql;

        return $this;
    }
    /**
     * Get the value of localhost
     */
    public function getLocalHost()
    {
        return $this->localhost;
    }

    /**
     * Set the value of localhost
     *
     * @return  self
     */
    public function setLocalHost($localhost)
    {
        $this->localhost = $localhost;

        return $this;
    }

    /**
     * Get the value of dbName
     */
    public function getNameAboutDb()
    {
        return $this->dbName;
    }

    /**
     * Set the value of dbName
     *
     * @return  self
     */
    public function setNameAboutDb($dbName)
    {
        $this->dbName = $dbName;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get the value of port
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set the value of port
     *
     * @return  self
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }
}
