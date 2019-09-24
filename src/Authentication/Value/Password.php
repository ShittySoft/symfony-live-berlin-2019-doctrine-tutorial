<?php

namespace Authentication\Value;

final class Password
{
    /** @var string */
    private $password;

    private function __construct(string $password)
    {
        $this->password = $password;
    }

    public static function fromString(string $password) : self
    {
        if (strlen($password) < 4) {
            throw new \InvalidArgumentException('Given password is too short');
        }

        return new self($password);
    }

    /**
     * @psalm-param callable(string) : string $toHash
     */
    public function toHash(callable $toHash) : PasswordHash
    {
        return PasswordHash::fromString($toHash($this->password));
    }

    /**
     * @psalm-param callable(string) : bool $verifyAgainstHash
     */
    public function verify(callable $verifyAgainstHash) : bool
    {
        return $verifyAgainstHash($this->password);
    }
}
