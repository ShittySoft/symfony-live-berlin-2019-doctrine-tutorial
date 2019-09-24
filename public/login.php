<?php

$usersFile = __DIR__ . '/../data/users.json';
$users = \json_decode(
    (string) @\file_get_contents($usersFile),
    true
) ?: [];

if (! \array_key_exists($_POST['emailAddress'], $users)) {
    echo 'Login failed';
    return;
}

if (! \password_verify($_POST['password'], $users[$_POST['emailAddress']])) {
    echo 'Login failed';
    return;
}

\session_start();
$_SESSION['user'] = $_POST['emailAddress'];

echo 'OK';
