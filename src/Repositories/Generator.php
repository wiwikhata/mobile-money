<?php

namespace DervisGroup\Pesa\Repositories;

/**
 * Class Generator
 * @package DervisGroup\Pesa\Repositories
 */
class Generator
{
    /**
     * Generate a random transaction number
     *
     * @return string
     */
    public static function generateTransactionNumber()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = \strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) {
            $randomString .= $characters[\rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
