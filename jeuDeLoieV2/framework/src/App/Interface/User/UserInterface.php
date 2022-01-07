<?php

namespace App\Interface\User;

interface UserInterface
{
    public function getId();
    public function setId(int $id);

    public function getUsername();
    public function setUsername(string $username);


    public function getPassword();
    public function setPassword(string $password);


    public function getLastName();
    public function setLastName(string $lastName);


    public function getFirstName();
    public function setFirstName(string $firstName);

    public function getMail();
    public function setMail(string $mail);


    public function getCreateAt();
    public function setCreateAt(string $createAt);


    public function getRoles();
    public function setRoles(string $roles);

    // CRUD 

    public function userExists(string $username);
    
    public function mailExists(string $mail);

    public function getUsers();

    public function insertUser($data);

    public function updateUser($dataUser);
   
    public function deleteUser($id_user);

    
    public function userConnection(string $username, string $password);

}