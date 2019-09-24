<?php

namespace Authentication\Value;

final class PasswordHash
{
    /** @var string */
    private $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public static function fromString(string $hash) : self
    {
        return new self($hash);
    }

    public function toString() : string
    {
        return $this->hash;
    }
}
