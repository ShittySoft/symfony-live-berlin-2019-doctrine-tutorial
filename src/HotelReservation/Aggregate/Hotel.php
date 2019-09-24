<?php

final class Hotel
{
    /** @var HotelName */
    private $name;

    /** @var array<int, Room> */
    private $rooms;

    public function book(Booking $reservation) : bool
    {
        // .. find matching room and date here ..
    }
}
