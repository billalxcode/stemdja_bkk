<?php

function rand_subname($firstname) {
    $length = strlen($firstname);
    if ($length >= 3) {
        $limit = random_int(2, $length - 1);
        return substr($firstname, 0, $limit);
    } else {
        return $firstname;
    }
}

function generate_email(string $name) {
    $email = [];
    
    $name = strtolower($name);
    $splitname = explode(" ", $name);

    $firstname = rand_subname($splitname[0]);
    if (count($splitname) >= 2) {
        $lastname = rand_subname($splitname[1]);
    }

    if (random_int(0, 1) == 1) {
        $number = random_int(0000, 9999);
    }

    $email[] = $firstname;
    $email[] = ".";
    if (isset($lastname)) {
        $email[] = $lastname;
    }
    if (isset($number)) {
        $email[] = $number;
    }

    $email[] = '@sibkk.net';

    return join("", $email);
}

function generate_username($name) {
    $username = [];

    $name = strtolower($name);
    $splitname = explode(" ", $name);
    
    $firstname = rand_subname($splitname[0]);
    if (count($splitname) >= 2) {
        $lastname = rand_subname($splitname[1]);
    }


    if (random_int(0, 1) == 1) {
        $number = random_int(0000, 9999);
    }

    $username[] = $firstname;
    if (isset($lastname)) {
        $username[] = $lastname;
    }
    if (isseT($number)) {
        $username[] = $number;
    }

    return join("", $username);
}