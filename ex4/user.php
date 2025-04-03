<?php
declare(strict_types=1);
class user{
    private int $id;
    private string $username;
    private string $email;
    private string $role;
    private string $password;
    public function __construct(int $id, string $name, string $email, string $role ,string $password) {
        $this->id = $id;
        $this->username = $name;
        $this->email = $email;
            $this->role = $role;
            $this->password = $password;
        }

    public function getId() {
        return $this->id;
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

    public function setId($id) {
        $this->id = $id;
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
        $stmt = $cnxex4->prepare("UPDATE users SET username = :username, email = :email, role = :role ,password = :password WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }
    public function supprimer_user($cnxex4) {
        $stmt = $cnxex4->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
    public function afficher_user($cnxex4) {
        $stmt = $cnxex4->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($cnxex4,$email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $cnxex4->prepare($sql);
        $stmt->execute(['email' => $email]); 
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start(); 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true; 
        }
        return false; 
    }
    public function authentification() {
        return isset($_SESSION['user_id']); 
    }
    public function logout() {
        session_unset(); 
        session_destroy(); 
    }
    public function isadmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; 
    }
    public function isuser() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'user'; 
    }

}
?>