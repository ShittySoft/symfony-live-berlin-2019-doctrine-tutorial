<?php

namespace Application;

use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\PhpVerifyPassword;

require_once __DIR__ . '/../vendor/autoload.php';

$users = new JsonFileUsers(__DIR__ . '/../data/users.json');
$email = EmailAddress::fromString($_POST['emailAddress']);
$password = Password::fromString($_POST['password']);

if (! $users->isRegistered($email)) {
    echo 'Login failed';
    return;
}

$user = $users->get($email);

if (! $user->logIn(new PhpVerifyPassword(), $password)) {
    echo 'Login failed';
    return;
}

\session_start();
$_SESSION['user'] = $email->toString();

echo 'OK';
