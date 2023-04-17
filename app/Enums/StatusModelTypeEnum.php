<?php

namespace App\Enums;

enum StatusModelTypeEnum: string
{
    case USERS = 'users';
    case VACANCIES = 'vacancies';
    case APPLICATIONS = 'applications';
}
