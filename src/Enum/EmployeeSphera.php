<?php

namespace App\Enum;

enum EmployeeSphera: string
{
    case PSYCHOLOGY = 'PSYCHOLOGY';
    case PEDAGOGY = 'PEDAGOGY';


    public function getLabel(): string
    {
        return match($this) {
            self::PSYCHOLOGY => 'Психология',
            self::PEDAGOGY => 'Педагогика',

        };
    }
}