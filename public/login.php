<?php

require_once __DIR__ . '/../vendor/autoload.php';

$users = new \Infrastructure\Authentication\Repository\JsonFileUsers(__DIR__ . '/../data/users.json');

if (! $users->isRegistered($_POST['emailAddress'])) {
    echo 'Login failed';
    return;
}

$user = $users->get($_POST['emailAddress']);

if (! \password_verify($_POST['password'], $user->passwordHash())) {
    echo 'Login failed';
    return;
}

\session_start();
$_SESSION['user'] = $user->emailAddress();

echo 'OK';
