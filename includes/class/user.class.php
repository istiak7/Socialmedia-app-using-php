<?php

class User
{

    public $database;

    public function __construct(Database $db)
    {
        $this->database = $db->getConnection();
    }

    public function userRegister($username, $email, $password)
    {

        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->database->prepare($query);
        $stmt->execute([$username, $email, $password]);

    }

    public function userLogin($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->database->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            // Authentication successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['username'];
            return true;
        }
        return false;
    }
    // check email already exist or not 
    public function checkEmailAlreadyExist($email)
    {

        $query = "SELECT email from users WHERE email = ?";
        $stmt = $this->database->prepare($query);
        $stmt->execute([$email]);
        return (bool) $stmt->fetch();
    }   
    //check username already exist or not 
    public function checkUsernameAlreadyExist($username)
    {

        $query = "SELECT username from users WHERE username = ?";
        $stmt = $this->database->prepare($query);
        $stmt->execute([$username]);
        return (bool) $stmt->fetch();
    
    }
}
