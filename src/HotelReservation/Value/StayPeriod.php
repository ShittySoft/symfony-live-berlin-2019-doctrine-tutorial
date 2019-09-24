<?php

final class StayPeriod
{
    public static function fromDates(StayDate $begin, StayDate $end) : self
    {
        \Webmozart\Assert\Assert::true($end->greaterThan($begin));
    }

    public function overlapsWith(self $other) : bool
    {

    }
}
