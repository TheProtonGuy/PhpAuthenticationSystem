<?php

declare(strict_types=1);

class RegisterValidator {

    private $username;
    private $email;
    private $password;
    private $confirm_password;
    private $pdo;

    function __construct(string $username, string $email, string $password, string $confirm_password, object $pdo){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->pdo = $pdo;
    }

    function validate_data(){

        $errors = [];

        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->confirm_password)) {
            $errors["incomplete_form"] = "Please fill all the fields";
        }

        if ($this->password !== $this->confirm_password) {
            $errors["password_match_error"] = "Passwords do not match";
        }

        if (strlen($this->password) < 5) {
            $errors["password_too_short"] =  "Password must be greater than or equal to 5 characters";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Please enter a valid email address";
        }

        if(!empty(get_user_username($this->pdo, $this->username))) {
            $errors["username_exists"] = "Username already exists";
        }

        if(!empty(get_user_email($this->pdo, $this->email))) {
            $errors["email_exists"] = "Email already exists";
        }

        if (!empty($errors)) {
            $_SESSION["signup_errors"] = $errors;
            header("Location: ../register.php");
            die();
        }

    }

};

class LoginValidator {

    private $username;
    private $password;
    private $pdo;

    function __construct(string $username, string $password,  object $pdo) {
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $pdo;
    }

    function get_user_data(){
        return get_user_username($this->pdo, $this->username);
    }

    function validate_data() {

        $errors = [];

        if (empty($this->username) || empty($this->password)) {
            $errors["incomplete_form"] = "Please fill all the fields";
        }

        $user = $this->get_user_data();

        if (!$user) {
            $errors["invalid_username"] = "Invalid username entered";
        }

        if ($user && !password_verify($this->password, $user["pwd"])) {
            $errors["invalid_password"] = "Invalid password entered";
        }

        if (!empty($errors)) {
            $_SESSION["login_errors"] = $errors;
            header("Location: ../login.php");
            die();
        }
        
    }

};