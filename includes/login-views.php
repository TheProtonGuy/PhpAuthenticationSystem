<?php

function render_message(){

    if (isset($_SESSION["signup_success"])) {

        $message = $_SESSION["signup_success"];

        echo '<center><h4 style="color:dodgerblue">' . $message . '</h4></center>';

        unset($_SESSION["signup_success"]);

    }

    if (isset($_SESSION["login_errors"])) {

        $errors = $_SESSION["login_errors"];

        foreach($errors as $error) {

            echo '<center><h4 style="color:firebrick">' . $error . '</h4></center>';

        }

        unset($_SESSION["login_errors"]);

    }

}