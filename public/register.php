<?php

namespace Application;

use Authentication\Aggregate\User;
use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Infrastructure\Authentication\Query\UserIsRegisteredInRepository;
use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\PhpHashPassword;

require_once __DIR__ . '/../vendor/autoload.php';

$users = new JsonFileUsers(__DIR__ . '/../data/users.json');
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
