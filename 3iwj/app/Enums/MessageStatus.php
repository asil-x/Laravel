<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Show()
 * @method static static Hide()
 */
final class MessageStatus extends Enum
{
    const Show = 0;
    const Hide = 1;
}
