<?php

namespace App\Enum;

enum ConsultationStatus: string
{
    case SCHEDULED = 'scheduled';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case MISSED = 'missed';

    public function getLabel(): string
    {
        return match($this) {
            self::SCHEDULED => 'Запланирована',
            self::IN_PROGRESS => 'В процессе',
            self::COMPLETED => 'Завершена',
            self::CANCELLED => 'Отменена',
            self::MISSED => 'Пропущена',
        };
    }
}