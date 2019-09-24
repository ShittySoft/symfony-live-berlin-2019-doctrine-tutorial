<?php

namespace Authentication\Service;

use Authentication\Value\Password;
use Authentication\Value\PasswordHash;

interface HashPassword
{
    public function __invoke(Password $password) : PasswordHash;
}
