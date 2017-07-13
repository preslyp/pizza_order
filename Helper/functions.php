<?php

function redirect($location)
{
    header("Location:{$location}");
    die();
}

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function dd($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
//    die();
}