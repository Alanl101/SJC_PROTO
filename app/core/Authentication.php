<?php

trait Authentication {
    
    public function startSession() {
        if (!session_id()) {
            session_start();
        }
    }

    public function login($user_id) {
        $this->startSession();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['last_activity'] = time();
        
        // Set a login status cookie
        setcookie('login_status', 'logged_in', time() + 3600, '/');
    }

    public function logout() {
        $this->startSession();
        session_destroy();
        
        // Expire and remove the login status cookie
        setcookie('login_status', '', time() - 3600, '/');
    }

    public function isAuthenticated() {
        $this->startSession();
        return isset($_SESSION['user_id']);
    }

    public function checkSessionTimeout() {
        $this->startSession();

        $sessionTimeout = 10 * 60; // 10 minutes in seconds

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $sessionTimeout) {
            $this->logout();
            return false;
        }

        $_SESSION['last_activity'] = time();

        return true;
    }
}
