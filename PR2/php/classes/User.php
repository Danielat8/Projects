<?php

class User
{

    private $email;
    private $password;
    private $name;
    private $surname;
    private $connObj;

    public function __construct($connObj, $name, $email, $surname, $password)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setSurname($surname);
        $this->setPassword($password);
        $this->setConnObj($connObj);
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Get the value of connObj
     */
    public function getConnObj()
    {
        return $this->connObj;
    }

    /**
     * Set the value of connObj
     *
     * @return  self
     */
    public function setConnObj($connObj)
    {
        $this->connObj = $connObj;

        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }


    public function checkConflicts()
    {
        $connObj = $this->getConnObj();
        $email = $this->getEmail();
        $name = $this->getName();
        $surname = $this->getSurname();
        $password = $this->getPassword();

        $conflicts = ['email' => false, 'name' => false, 'surname' => false, 'password' => false];

        // Check email conflict
        $sql = "SELECT * FROM users WHERE email = :email";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->bindParam(":email", $email, PDO::PARAM_STR);
        $pdo_statement->execute();
        if ($pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            $conflicts['email'] = true;
        }

        // Check name conflict
        $sql = "SELECT * FROM users WHERE name = :name";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->bindParam(":name", $name, PDO::PARAM_STR);
        $pdo_statement->execute();
        if ($pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            $conflicts['name'] = true;
        }

        // Check surname conflict
        $sql = "SELECT * FROM users WHERE surname = :surname";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $pdo_statement->execute();
        if ($pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            $conflicts['surname'] = true;
        }

        // Check password conflict
        $sql = "SELECT * FROM users";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->execute();
        while ($user = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $user['password'])) {
                $conflicts['password'] = true;
                break;
            }
        }

        return $conflicts;
    }
    public function userExists()
    {
        $connObj = $this->getConnObj();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $name = $this->getName();
        $surname = $this->getSurname();

        $sql = "SELECT * FROM users WHERE email = :email AND password = :password AND name = :name AND surname = :surname";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->bindParam(":email", $email, PDO::PARAM_STR);
        $pdo_statement->bindParam(":password", $password, PDO::PARAM_STR);
        $pdo_statement->bindParam(":name", $name, PDO::PARAM_STR);
        $pdo_statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $pdo_statement->execute();
        $user = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return true;
        }
        return false;
    }


    public function addUser()
    {
        $connObj = $this->getConnObj();
        $name = $this->getName();
        $email = $this->getEmail();
        $surname = $this->getSurname();
        $password_hash = password_hash($this->getPassword(), PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, surname, password) VALUES (:name, :email, :surname, :password)";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->bindParam(":name", $name, PDO::PARAM_STR);
        $pdo_statement->bindParam(":email", $email, PDO::PARAM_STR);
        $pdo_statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $pdo_statement->bindParam(":password", $password_hash,  PDO::PARAM_STR);
        $userAdded = $pdo_statement->execute();
        if (!$userAdded) {
            echo "User was not added, an error has occured";
            die();
        }
    }
    public function authenticate()
    {
        $connObj = $this->getConnObj();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $sql = "SELECT * FROM users WHERE email = :email";
        $pdo_statement = $connObj->prepare($sql);
        $pdo_statement->bindParam(":email", $email, PDO::PARAM_STR);
        $pdo_statement->execute();
        $user = $pdo_statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ['error' => 'email'];
        }

        if (!password_verify($password, $user['password'])) {
            return ['error' => 'password'];
        }

        return ['success' => $user['id'], 'role' => $user['role']];
    }
}
