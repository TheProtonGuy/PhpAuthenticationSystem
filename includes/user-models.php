<?php

declare(strict_types=1);

function get_user_username(object $pdo, string $username) {

    $query = "SELECT * FROM users WHERE username = :username;";
    $statement = $pdo->prepare($query);

    $statement->bindparam(":username", $username);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC); 
    
    return $result;
}

function get_user_email(object $pdo, string $email) {

    $query = "SELECT * FROM users WHERE email = :email;";
    $statement = $pdo->prepare($query);

    $statement->bindparam(":email", $email);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC); 
    
    return $result;
}

function create_user(object $pdo, string $username, string $email, string $password) {

    $query = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd);";

    $statement = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    $statement->bindparam(":username", $username);
    $statement->bindparam(":email", $email);
    $statement->bindparam(":pwd", $hashed_password);

    $statement->execute();


}
