<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StoryType extends Enum implements LocalizedEnum
{
    const REASON = 'reason';
    const EFFORT = 'effort';
    const ENHANCEMENT = 'enhancement';
}
