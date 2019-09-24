<?php

require_once __DIR__ . '/../vendor/autoload.php';

$users = new \Infrastructure\Authentication\Repository\JsonFileUsers(__DIR__ . '/../data/users.json');

if ($users->isRegistered($_POST['emailAddress'])) {
    echo 'Already registered';
    return;
}

$passwordHash = \password_hash($_POST['password'], \PASSWORD_DEFAULT);

$users->store(new \Authentication\Entity\User($_POST['emailAddress'], $passwordHash));

\error_log(\sprintf('Here goes an email to "%s"', $_POST['emailAddress']));

echo 'OK';
