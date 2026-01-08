<?php 

namespace code\models;
use code\config\database;
use PDOException;

Class User
{
    private $userid;
    private $username;
    private $email;
    private $password;
    private $role;

    public function setName($name)
    {
        $this->username = $name;
    }

    public function getName()
    {
        return $this->username;
    }

    public function setEmail($useremail)
    {
        $this->email = $useremail;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setUserId($userid)
    {
        $this->userid = $userid;
    }

    public function getUserId()
    {
        return $this->userid;
    }
    
    public function login()
    {
        $sql = "SELECT * FROM users
                WHERE email = ?";
        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute([$this->email]);

        $mail = $stmt->fetch();

        if($mail['email'] === $this->email){
            if($mail['user_password'] == md5($this->password)){
                $this->setUserId($mail['user_id']);
                $this->setName($mail['user_name']);
                $this->setRole($mail['role']);
                return true;
            }else{
                return false;
            }
            
        }
        
    }

    public function register(){

        $sql = "SELECT email FROM users
                WHERE email = ?";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([ $this->email ]);

        if ($stmt->fetch()){
            return false;
        }

            $register = "INSERT INTO users(user_name, email, user_password) 
                         VALUES ( ?, ?, ?)";
            $stmt2 = DataBase::Connect()->prepare($register);
            $stmt2->execute([$this->username, $this->email, md5($this->password) ]);
            return true;
        
    }

    public function logOut():bool
    {
         
        session_unset();
        session_destroy();
        return true;
    
    }
}
?>