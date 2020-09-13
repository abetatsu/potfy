<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SocialType extends Enum implements LocalizedEnum
{
    const GITHUB = 'github';
    const TWITTER = 'twitter';
    const WANTEDLY = 'wantedly';
}
