<?php


class Admin {
    use Controller;
    use Model;

    public function index() {
        $admin = false;

        // Check post request for admin login data
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $table = "admin";

            $admin = $this->login($_POST['username'], $_POST['password'], $table);

        }


        // authenticate admin (are they in the database) and start session
        



        // Check if the user is authenticated as an admin and has an active session.
        if ($admin) {
            // User is authenticated as an admin, so display the admin page.
            $this->view('admin');
        } else {
            // User is not authenticated as an admin, so display the login page.
            $this->view('adminlogin');
        }
    }
    
}
