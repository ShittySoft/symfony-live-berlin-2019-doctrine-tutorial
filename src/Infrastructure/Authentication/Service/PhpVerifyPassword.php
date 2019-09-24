<?php

namespace Infrastructure\Authentication\Service;

use Authentication\Service\VerifyPassword;

final class PhpVerifyPassword implements VerifyPassword
{
    public function __invoke(string $password, string $hash) : bool
    {
        return \password_verify($password, $hash);
    }
}
