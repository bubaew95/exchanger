<?php

namespace App\Enum;

enum AdvertisementStatus: int
{
    case ACTIVE = 1;
    case NOT_ACTIVE = 2;
    case BAN = 3;
    case DELETE = 4;
}
