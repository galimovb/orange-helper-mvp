<?php

namespace App\Enum;

enum ConsultationType: string
{
    case PSYCHOLOGICAL = 'psychological';
    case PEDAGOGICAL = 'pedagogical';

    public function getLabel(): string
    {
        return match($this) {
            self::PSYCHOLOGICAL => 'Психологическая консультация',
            self::PEDAGOGICAL => 'Педагогическая консультация',
        };
    }

    public static function getTypes(): array
    {
        return [
            self::PSYCHOLOGICAL->value => self::PSYCHOLOGICAL->getLabel(),
            self::PEDAGOGICAL->value => self::PEDAGOGICAL->getLabel(),
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