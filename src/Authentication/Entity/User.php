<?php

namespace Authentication\Entity;

class User
{
    /** @var string */
    private $emailAddress;

    /** @var string */
    private $passwordHash;

    public function __construct(string $emailAddress, string $passwordHash)
    {
        $this->emailAddress  = $emailAddress;
        $this->passwordHash = $passwordHash;
    }

    public function emailAddress() : string
    {
        return $this->emailAddress;
    }

    public function passwordHash() : string
    {
        return $this->passwordHash;
    }
}
