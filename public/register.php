<?php

$usersFile = __DIR__ . '/../data/users.json';
$users = \json_decode(
    (string) @\file_get_contents($usersFile),
    true
) ?: [];

if (\array_key_exists($_POST['emailAddress'], $users)) {
    echo 'Already registered';
    return;
}

$passwordHash = \password_hash($_POST['password'], \PASSWORD_DEFAULT);

$users[$_POST['emailAddress']] = $passwordHash;

\error_log(\sprintf('Here goes an email to "%s"', $_POST['emailAddress']));

\file_put_contents($usersFile, \json_encode($users));

echo 'OK';
