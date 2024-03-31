<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Todo = 'Todo';

    case OnProgress = 'Proses';

    case Done = 'Selesai';

}