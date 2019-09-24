<?php

final class Booking
{
    /** @var StayPeriod */
    private $stayPeriod;

    /** @var Pax */
    private $pax;

    /** @var array<int, HotelGuest> */
    private $guests;
}
