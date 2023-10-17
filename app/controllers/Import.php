<?php

class Import {
    use Controller;
    use Authentication;

    public function index() {
        // Check if the user is authenticated as an admin and has an active session.
        if ($this->isAuthenticated()) {
            // User is authenticated as an admin, so display the admin page.
            $this->view('admin');
        } else {
            // User is not authenticated as an admin, so display the login page.
            $this->view('adminlogin');
        }
    }
    
}
