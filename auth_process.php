<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$userDao = new UserDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);
$type = filter_input(INPUT_POST, "type");

if ($type === 'register') {
    $nome = filter_input(INPUT_POST, "name");
    $sobrenome = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $password_confirmed = filter_input(INPUT_POST, "confirmepassword");

    if ($nome && $sobrenome && $email && $password && $password_confirmed) {

        if ($password === $password_confirmed) {
            if ($userDao->findByEmail($email) === false) {
                $user = new User();
                $userToken = $user->generateToken();
                $finalPassword = $user->generatePassword($password);

                $user->name     = $nome;
                $user->lastname = $sobrenome;
                $user->email    = $email;
                $user->password = $finalPassword;
                $user->token    = $userToken;

                $auth = true;
                $userDao->create($user, $auth);
            } else {
                $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "auth.php");
            }
        } else {
            $message->setMessage("As senhas não batem", "error", "auth.php");
        }
    } else {
        $message->setMessage("Por favor, preencha todos os campos.", "error", "auth.php");
    }
} else if ($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    if ($userDao->authenticateUser($email, $password)) {
        $message->setMessage("Seja Bem-vendo!", "Success", "editprofile.php");
    } else {
        $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");
    }
}
