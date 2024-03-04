<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    try {

        require_once 'db.php';
        require_once 'user-models.php';
        require_once 'validator.php';

        $validate_user = new LoginValidator($username, $password, $pdo);
        $validate_user->validate_data();

        $_SESSION["user"] = $validate_user->get_user_data();

        header("Location: ../index.php");
        die();
        
    } catch (PDOException $e) {
        die("Sql query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../login.php");
    die();
}