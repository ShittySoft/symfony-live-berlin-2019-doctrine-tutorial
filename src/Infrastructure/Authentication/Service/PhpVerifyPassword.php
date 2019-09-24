<?php

namespace Infrastructure\Authentication\Service;

use Authentication\Service\VerifyPassword;
use Authentication\Value\Password;
use Authentication\Value\PasswordHash;

final class PhpVerifyPassword implements VerifyPassword
{
    public function __invoke(Password $password, PasswordHash $hash) : bool
    {
        return $password->verify(static function (string $password) use ($hash) : bool {
            return \password_verify($password, $hash->toString());
        });
    }
}
