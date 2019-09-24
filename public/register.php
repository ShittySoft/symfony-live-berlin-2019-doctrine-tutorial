<?php

namespace Application;

use Authentication\Aggregate\User;
use Infrastructure\Authentication\Query\UserIsRegisteredInRepository;
use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\PhpHashPassword;

require_once __DIR__ . '/../vendor/autoload.php';

$users = new JsonFileUsers(__DIR__ . '/../data/users.json');

if ($users->isRegistered($_POST['emailAddress'])) {
    echo 'Already registered';
    return;
}

$users->store(User::register(
    new UserIsRegisteredInRepository($users),
    new PhpHashPassword(),
    $_POST['emailAddress'],
    $_POST['password']
));

\error_log(\sprintf('Here goes an email to "%s"', $_POST['emailAddress']));

echo 'OK';
