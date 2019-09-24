<?php

namespace Application;

use Authentication\Aggregate\User;
use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Infrastructure\Authentication\Query\UserIsRegisteredInRepository;
use Infrastructure\Authentication\Repository\DoctrineRepositoryUsers;
use Infrastructure\Authentication\Service\PhpHashPassword;

$entityManager = require __DIR__ . '/../bootstrap.php';

$users = new DoctrineRepositoryUsers(
    $entityManager->getRepository(User::class),
    $entityManager
);
$email = EmailAddress::fromString($_POST['emailAddress']);
$password = Password::fromString($_POST['password']);

if ($users->isRegistered($email)) {
    echo 'Already registered';
    return;
}

$users->store(User::register(
    new UserIsRegisteredInRepository($users),
    new PhpHashPassword(),
    $email,
    $password
));

\error_log(\sprintf('Here goes an email to "%s"', $_POST['emailAddress']));

echo 'OK';
