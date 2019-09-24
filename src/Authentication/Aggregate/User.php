<?php

namespace Authentication\Aggregate;

use Authentication\Exception\UserAlreadyRegistered;
use Authentication\Query\UserIsRegistered;
use Authentication\Service\HashPassword;
use Authentication\Service\VerifyPassword;

class User
{
    /** @var string */
    private $emailAddress;

    /** @var string */
    private $passwordHash;

    private function __construct(string $emailAddress, string $passwordHash)
    {
        $this->emailAddress  = $emailAddress;
        $this->passwordHash = $passwordHash;
    }

    public static function unserializeFrom(string $emailAddress, string $passwordHash) : self
    {
        return new self($emailAddress, $passwordHash);
    }

    public static function register(
        UserIsRegistered $isRegistered,
        HashPassword $hashPassword,
        string $emailAddress,
        string $password
    ) : self {
        if ($isRegistered($emailAddress)) {
            throw new UserAlreadyRegistered('...');
        }

        return new self($emailAddress, $hashPassword($password));
    }

    public function logIn(VerifyPassword $verifyPassword, string $password) : bool
    {
        return $verifyPassword($password, $this->passwordHash);
    }
}
