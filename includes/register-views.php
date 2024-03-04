<?php

function render_errors(){

    if (isset($_SESSION["signup_errors"])) {

        $errors = $_SESSION["signup_errors"];

        foreach($errors as $error) {

            echo '<center><h4 style="color:firebrick">' . $error . '</h4></center>';

        }

        unset($_SESSION["signup_errors"]);

    }

}