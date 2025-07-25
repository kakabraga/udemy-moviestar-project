<?php
require_once("models/User.php");
require_once("models/Message.php");

class UserDAO implements UserDAOInterface
{
    private $conn;
    private $url;
    private $message;
    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }
    public function buildUser($data)
    {
        $user = new User();
        $user->id           = $data["id"];
        $user->name         = $data["name"];
        $user->lastname     = $data["lastname"];
        $user->email        = $data["email"];
        $user->password     = $data["password"];
        $user->image        = $data["image"];
        $user->token        = $data["token"];
        $user->bio          = $data["bio"];

        return $user;
    }
    public function create(User $user, $authUser = false)
    {
        if (!empty($user)) {
            $stmt = $this->conn->prepare("INSERT INTO users( name, lastname, email, password, token) 
            VALUES (:name, :lastname, :email, :password, :token)");
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':lastname', $user->lastname);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':password', $user->password);
            $stmt->bindParam(':token', $user->token);
            $stmt->execute();

            if ($authUser) {
                $this->setTokenToSession($user->token);
            }
            return true;
        } else {
            return false;
        }
    }
    public function update(User $user, $redirect = true)
    {
        if (!empty($user)) {
            $stmt = $this->conn->prepare("UPDATE users SET name = :name, lastname = :lastname, email = :email, token = :token, bio = :bio WHERE id = :id");
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':lastname', $user->lastname);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':token', $user->token);
            $stmt->bindParam(':bio', $user->bio);
            $stmt->bindParam(':id', $user->id);
            $stmt->execute();
            if ($redirect) {
                $this->message->setMessage("Dados atualizados com sucesso", "Success", "editprofile.php");
            }
        }
    }
    public function verifyToken($protected = false)
    {

        if (!empty($_SESSION["token"])) {

            // Pega o token da session
            $token = $_SESSION["token"];

            $user = $this->findByToken($token);

            if ($user) {
                return $user;
            } else if ($protected) {

                // Redireciona usuário não autenticado
                $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
            }
        } else if ($protected) {

            // Redireciona usuário não autenticado
            $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
        }
    }
    public function setTokenToSession($token, $redirect = true)
    {

        $_SESSION["token"] = $token;

        if ($redirect) {
            $this->message->setMessage("Seja Bem-vendo!", "Success", "editprofile.php");
        }
    }
    public function authenticateUser($email, $password)
    {

        $user = $this->findByEmail($email);
        if ($user) {

            if (password_verify($password, $user->password)) {

                $token = $user->generateToken();

                $this->setTokenToSession($token, false);

                $user->token = $token;

                $this->update($user, false);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function findByEmail($email)
    {
        if ($email != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email= :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            } else {
                return false;
            }
        }
        return false;
    }
    public function findById($id)
    {
        if (!empty($id)) {

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id= :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            } else {
                return false;
            }
        }
    }
    public function findByToken($token)
    {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token= :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
        } else {
            return false;
        }
    }
    public function destroyToken()
    {
        $_SESSION["token"] = "";
        $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");
    }
    public function changePassword(User $user) {}

}
