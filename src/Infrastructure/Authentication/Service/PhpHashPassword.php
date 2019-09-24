<?php

namespace Infrastructure\Authentication\Service;

use Authentication\Service\HashPassword;
use Authentication\Value\Password;
use Authentication\Value\PasswordHash;

final class PhpHashPassword implements HashPassword
{
    public function __invoke(Password $password) : PasswordHash
    {
        return $password->toHash(static function (string $password) : string {
            return (string) \password_hash($password, \PASSWORD_DEFAULT);
        });
    }
}
