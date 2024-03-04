<?php

session_start();

if (!isset($_SESSION["user"])){
    header("Location: login.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo "Hello world."; ?>
    <br><a href="logout.php">Logout</a>

    <?php  

    echo '<br>';
    echo $_SESSION["user"]["username"];
    echo '<br>';
    echo $_SESSION["user"]["email"];

    ?>
</body>
</html>