<?php

namespace App\Enum;

use App\Enum\Trait\TranslatableTrait;
use Symfony\Contracts\Translation\TranslatableInterface;

enum Status: string implements TranslatableInterface
{
    use TranslatableTrait;

    case ACCEPTED = 'Accepted';
    case PENDING = 'Pending';
    case REJECTED = 'Rejected';
}