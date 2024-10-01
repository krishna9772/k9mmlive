<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Status: string
{
    use EnumToArray;
    case Active = 'Active';
    case Inactive = 'Inactive';
}
