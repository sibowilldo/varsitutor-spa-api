<?php

namespace App\Enums;

enum LocationEnum: string
{
    case RITSON = 'Ritson Campus';
    case STEVE_BIKO = 'Steve Biko Campus';
    case ML_SULTAN = 'ML Sultan Campus';
    case INDUMISO = 'Indumiso Campus';

    public static function toArray(): array
    {
        $locationArray = [];
        foreach (self::cases() as $location) {
            $locationArray[] = [$location->name => $location->value];
        }

        return $locationArray;
    }
}
