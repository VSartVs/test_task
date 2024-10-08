<?php

namespace App\Enums;

enum LeadStatusEnum: string
{
    case NEW = 'новый';
    case IN_PROCESS = 'в работе';
    case COMPLETED = 'завершен';
}
