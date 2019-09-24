<?php

final class Room
{
    /** @var RoomNumber */
    private $name;

    /** @var RoomPaxCapacity */
    private $capacity;

    /** @var array<int, Reservation> */
    private $reservations;
}
