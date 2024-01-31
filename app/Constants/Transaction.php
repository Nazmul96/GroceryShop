<?php 

namespace App\Constants;

class Transaction
{
    public const TYPE_INCOME   = 'income';
    public const TYPE_EXPENSE  = 'expense';

    public const LIST = [
        self::TYPE_INCOME,
        self::TYPE_EXPENSE
    ];
}