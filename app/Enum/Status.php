<?php

namespace App\Enum;

enum Status: string
{
    case OPEN     = 'open';
    case CLOSED   = 'closed';
    case CANCELED = 'canceled';
}
