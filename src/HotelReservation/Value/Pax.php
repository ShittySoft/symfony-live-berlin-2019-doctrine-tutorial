<?php

/** @psalm-immutable */
final class Pax
{
    public static function fromInteger(int $amount) : self
    {
        \Webmozart\Assert\Assert::greaterThan($amount, 0);
    }
}
