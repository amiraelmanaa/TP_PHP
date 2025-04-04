<?php
declare(strict_types=1);
class user{
    private int $cin;
    private string $username;
    private string $email;
    private string $role;
    private string $password;
    public function __construct( string $email,string $password) {
        
        $this->email = $email;
            
            $this->password = $password;
        }

    public function getCin() {
        return $this->cin;
    }

    public function getName() {
        return $this->username;
    }

    public function getemail() {
        return $this->email;
    }

    public function getrole() {
        return $this->role;
    }
    public function getpassword() {
        return $this->password;
    }
    public function setpassword($password) {
        $this->password = $password;
    }

    public function setCin(int $cin) {
        $this->cin = $cin;
    }
    public function setName($name) {
        $this->username = $name;
    }
    public function setemail($email) {
        $this->email = $email;
    }
    public function setrole($role) {
        $this->role = $role;
    }
    public function ajouter_user($cnxex4) {
        $stmt = $cnxex4->prepare("INSERT INTO users (username, email, role,password) VALUES (:username, :email, :role,:password)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }


    public function modifier_user($cnxex4) {
    
    $stmt = $cnxex4->prepare("UPDATE users SET username = :username, email = :email, role = :role, password = :password WHERE cin = :cin");
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':role', $this->role);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':cin', $this->cin); 
    return $stmt->execute();
}


    public function supprimer_user($cnxex4) {
        $stmt = $cnxex4->prepare("DELETE FROM users WHERE cin = :cin");
        $stmt->bindParam(':cin', $this->cin);
        return $stmt->execute();
    }




    public function afficher_user($cnxex4, $cin) {
        $stmt = $cnxex4->prepare("SELECT * FROM users WHERE cin = :cin");
        $stmt->bindParam(':cin', $cin, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $this->cin = $user['cin']; 
            $this->username = $user['username']; 
            $this->email = $user['email'];  
            $this->role = $user['role']; 
        }
        
        return $user;
    }
    
    



    public function login($cnxex4, $email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $cnxex4->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        
      
        error_log("Tentative de connexion pour l'email: " . $email);
        
        if ($user) {
          
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_cin'] = $user['cin'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_password'] = $user['password'];
                
                return true;
            } else {
                
                if ($password === $user['password']) {
                    $_SESSION['user_cin'] = $user['cin'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_password'] = $user['password'];
                    return true;
                }
            }
        }
        return false;
    }
    public function authentification() {
        return isset($_SESSION['user_cin']); 
    }
    public function isadmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; 
    }
    public function isuser() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'user'; 
    }

}
?>