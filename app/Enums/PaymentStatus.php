<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Unpaid = 'Belum Bayar';

    case Paid = 'Diayar';

}