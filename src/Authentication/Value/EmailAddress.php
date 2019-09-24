<?php

namespace Authentication\Value;

final class EmailAddress
{
    /** @var string */
    private $emailAddress;

    private function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public static function fromString(string $emailAddress) : self
    {
        if (! \filter_var($emailAddress, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(\sprintf('Invalid email address "%s"', $emailAddress));
        }

        return new self($emailAddress);
    }

    public function toString() : string
    {
        return $this->emailAddress;
    }
}
