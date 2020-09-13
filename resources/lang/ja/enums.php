<?php
// resources/lang/ja/enums.php
use App\Enums\StoryType;
use App\Enums\SocialType;

return [
    StoryType::class => [
        StoryType::REASON => '作った理由',
        StoryType::EFFORT =>'力入れた点',
        StoryType::ENHANCEMENT => '展望',
    ],
    SocialType::class => [
        SocialType::GITHUB => 'GitHub',
        SocialType::TWITTER =>'Twitter',
        SocialType::WANTEDLY => 'Wantedly',
    ],
];
