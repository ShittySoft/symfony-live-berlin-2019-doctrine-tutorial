<?php

namespace Application;

use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\PhpVerifyPassword;

require_once __DIR__ . '/../vendor/autoload.php';

$users = new JsonFileUsers(__DIR__ . '/../data/users.json');

if (! $users->isRegistered($_POST['emailAddress'])) {
    echo 'Login failed';
    return;
}

$user = $users->get($_POST['emailAddress']);

if (! $user->logIn(new PhpVerifyPassword(), $_POST['password'])) {
    echo 'Login failed';
    return;
}

\session_start();
$_SESSION['user'] = $_POST['emailAddress'];

echo 'OK';
