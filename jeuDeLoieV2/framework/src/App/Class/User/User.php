<?php

namespace App\Class\User;
use App\Class\Connection\Connection;
use App\Interface\User\UserInterface;
use PDO;

class User implements UserInterface
{

    private int $id;
    private string $username;
    private string $password;
    private string $lastName;
    private string $firstName;
    private string $mail;
    private string $roles;
    private string $createAt;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }


    public function setUsername(string $username) : User
    {
        $this->username = $username;
        return $this;
    }


    public function getPassword(): string
    {
        return $this->password;
    }



    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }


    public function getLastName(): string
    {
        return $this->lastName;
    }



    public function setLastName(string $lastName) : User
    {
        $this->lastName = $lastName;
        return $this;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }


    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getMail(): string
    {
        return $this->mail;
    }


    public function setMail(string $mail): User
    {
        $this->mail = $mail;
        return $this;
    }


    public function getCreateAt(): string
    {
        return $this->createAt;
    }


    public function setCreateAt(string $createAt): User
    {
        $this->createAt = $createAt;
        return $this;
    }


    public function getRoles(): string
    {
        return $this->roles;
    }


    public function setRoles(string $roles): User
    {
        $this->roles = $roles;
        return $this;
    }


    public function __construct(
        $username = "",
        $password = "",
        $firstName = "",
        $lastName = "",
        $mail = "",
        $roles = "",
        $createAt = "",

    ) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setMail($mail);
        $this->setRoles($roles);
        $this->setCreateAt($createAt);
    }

    // ---------------------------------------------------------------- CRUD users

    public function getUsers(): array
    {
        $db = Connection::get();
        $stmt = $db->prepare("SELECT * FROM `users` ");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function userExists(string $username): bool
    {
        $db = Connection::get();
        $stmt = $db->prepare("SELECT COUNT(*) as nb FROM `users` WHERE `username` = :username");
        $stmt->bindParam('username', $username, PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['nb'] > 0;
        }
        return false;

    }

    public function mailExists(string $mail): bool
    {
        $db = Connection::get();
        $stmt = $db->prepare("SELECT COUNT(*) as nb FROM `users` WHERE `mail` = :mail");
        $stmt->bindParam('mail', $mail, PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['nb'] > 0;
        }
        return false;

    }

    public function insertUser($data): bool
    {
        $date = date("Y-m-d");
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $db = Connection::get();
        $sql = 'INSERT INTO 
            users(`username`, `password`, `lastName`, `firstName`, `mail`, `roles`, `createAt`) 
            VALUES 
                (:username, :password, :lastName, :firstName, :mail, :roles, :createAt)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam('username', $data['username'], PDO::PARAM_STR);
        $stmt->bindParam('password', $password, PDO::PARAM_STR);
        $stmt->bindParam('lastName', $data['lastName'], PDO::PARAM_STR);
        $stmt->bindParam('firstName', $data['firstName'], PDO::PARAM_STR);
        $stmt->bindParam('mail', $data['mail'], PDO::PARAM_STR);
        $stmt->bindParam('roles', $data['roles'], PDO::PARAM_STR);
        $stmt->bindParam('createAt', $date, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updateUser($dataUser) : bool
    {
        $connection = Connection::get();
        $sql = "UPDATE `users` SET 
         `firstName`=  '$dataUser[firstName]', 
         `lastName` = '$dataUser[lastName]', 
         `mail` = '$dataUser[mail]', 
         `roles` =  '$dataUser[roles]'
          WHERE `users`.id_user = '$dataUser[id_user]' ;";
        $stmt = $connection->prepare($sql);
        return $stmt->execute();
    }

    public function deleteUser($id_user) : array
    {
        $connection = Connection::get();
        $sql = "DELETE FROM `users` WHERE `users`.`id_user` = $id_user";
        $stmt = $connection->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function userConnection(string $username, string $password)
    {

        $db = Connection::get();
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $stmt->bindParam('username', $username, PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (!password_verify($password, $result[0]['password'])) {
                return false;
            } else {
                $_SESSION['user'] = [
                    "username" => $result[0]['username'],       
                    "roles" => $result[0]['roles'] 
                ];
                return $_SESSION['user']; 
            }
        }
        return [];

    }
    public function filterArrayByKeyValue($array, $key, $keyValue)
    {
        return array_filter($array, function($value) use ($key, $keyValue) {
            return $value[$key] == $keyValue;
        });
    }

}

