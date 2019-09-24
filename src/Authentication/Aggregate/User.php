<?php

namespace Authentication\Aggregate;

use Authentication\Exception\UserAlreadyRegistered;
use Authentication\Query\UserIsRegistered;
use Authentication\Service\HashPassword;
use Authentication\Service\VerifyPassword;
use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Authentication\Value\PasswordHash;

class User
{
    /** @var EmailAddress */
    private $emailAddress;

    /** @var PasswordHash */
    private $passwordHash;

    private function __construct(EmailAddress $emailAddress, PasswordHash $passwordHash)
    {
        $this->emailAddress  = $emailAddress;
        $this->passwordHash = $passwordHash;
    }

    public static function register(
        UserIsRegistered $isRegistered,
        HashPassword $hashPassword,
        EmailAddress $emailAddress,
        Password $password
    ) : self {
        if ($isRegistered($emailAddress)) {
            throw new UserAlreadyRegistered('...');
        }

        return new self($emailAddress, $hashPassword($password));
    }

    public function logIn(VerifyPassword $verifyPassword, Password $password) : bool
    {
        return $verifyPassword($password, $this->passwordHash);
    }
}
