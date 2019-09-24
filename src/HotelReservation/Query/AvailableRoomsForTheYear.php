<?php

interface AvailableRoomsForTheYear
{
    /** array<array{0: StayPeriod, 1: RoomNumber, 2: RoomPaxCapacity}> */
    public function __invoke(HotelName $hotel) : array;
}
