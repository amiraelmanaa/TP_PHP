<?php
class SessionManager {
    private $session_key = "visit_count";//heda ilkey taa dic session genre session[session_key] = n 
    public function __construct() {
        session_start();
        if (!isset($_SESSION[$this->session_key])) {
            $_SESSION[$this->session_key] =0;
        }
    }
    public function incrementVisitCount() {
        $_SESSION[$this->session_key]++;
    }
    public function getVisitCount() {
        return $_SESSION[$this->session_key];
    }
    public function resetSession() {
        session_unset();
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);//yrajaak li index.php ;il path ili ena fih waktha 
        exit();
    }
}
?>