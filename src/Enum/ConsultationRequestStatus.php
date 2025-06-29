<?php
namespace App\Enum;

enum ConsultationRequestStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';


    public function getLabel(): string
    {
        return match($this) {
            self::PENDING => 'Ожидает подтверждения',
            self::APPROVED => 'Подтверждена',
            self::REJECTED => 'Отклонена',
        };
    }

    public static function getTypes(): array
    {
        return [
            self::PENDING->value => self::PENDING->getLabel(),
            self::APPROVED->value => self::APPROVED->getLabel(),
            self::REJECTED->value => self::REJECTED->getLabel(),
        ];
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

}