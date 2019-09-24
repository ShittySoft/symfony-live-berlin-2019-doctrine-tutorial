<?php

namespace Infrastructure\Authentication\Service;

use Authentication\Service\HashPassword;

final class PhpHashPassword implements HashPassword
{
    public function __invoke(string $password) : string
    {
        return (string) \password_hash($password, \PASSWORD_DEFAULT);
    }
}
