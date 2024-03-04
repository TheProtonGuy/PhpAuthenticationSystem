<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    try {
        require_once 'db.php';
        require_once 'user-models.php';
        require_once 'validator.php';

        $validate_user_data = new RegisterValidator($username, $email, $password, $confirm_password, $pdo);
        $validate_user_data->validate_data();

        create_user($pdo, $username, $email, $password);

        $_SESSION["signup_success"] = "Signup succfessful. Procced to login";

        header("Location: ../login.php");
        die();
    } catch (PDOException $e) {
        die("Sql query failed: " . $e->getMessage());
    }


} else {
    header("Location: ../register.php");
    die();
}