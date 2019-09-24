<?php

namespace Application;

use Authentication\Aggregate\User;
use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Infrastructure\Authentication\Repository\DoctrineRepositoryUsers;
use Infrastructure\Authentication\Service\PhpVerifyPassword;

$entityManager = require __DIR__ . '/../bootstrap.php';

$users = new DoctrineRepositoryUsers(
    $entityManager->getRepository(User::class),
    $entityManager
);
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
