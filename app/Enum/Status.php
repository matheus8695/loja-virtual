<?php

namespace App\Enum;

enum Status: string
{
    case OPEN     = 'open';
    case FINISHED = 'finished';
    case CANCELED = 'canceled';
}
