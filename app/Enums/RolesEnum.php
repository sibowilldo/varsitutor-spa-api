<?php

namespace App\Enums;

enum RolesEnum: string
{
    // case NAMEINAPP = 'name-in-database';

    case ADMIN = 'administrator';
    case HOD = 'head-of-department';
    case TEACHER = 'teacher-lecture';
    case APPLICANT = 'student-application';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::WRITER => 'Writers',
            static::EDITOR => 'Editors',
            static::USERMANAGER => 'User Managers',
        };
    }
}
