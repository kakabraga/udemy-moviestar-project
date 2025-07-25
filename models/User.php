<?php

class User
{
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $image;
    public $token;
    public $bio;

    public function getFullName(User $user)
    {
        $fullname = $user->name . " " . $user->lastname;
        return $fullname;
    }
    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }
    public function generatePassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

interface UserDAOInterface
{
    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function destroyToken();
    public function update(User $user, $redirect);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function changePassword(User $user);
}
