<?php

namespace App\Enum;

namespace App\Enum;

enum JobRequestStatus: string
{
    case NEW = 'NEW';
    case ACCEPTED = 'ACCEPTED';
    case REJECTED = 'REJECTED';
    public function getLabel(): string
    {
        return match($this) {
            self::NEW => 'Новая',
            self::ACCEPTED => 'Принята',
            self::REJECTED => 'Отклонена',
        };
    }
}
