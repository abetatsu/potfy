<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StoryType extends Enum
{
    const REASON = 'reason';
    const EFFORT = 'effort';
    const ENHANCEMENT = 'enhancement';
}
