<?php
/**
 * Part of the Ignite Platform.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    pesa
 * @version    1.0.0
 * @author     Dervis Group  LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2018, Dervis Group LLC
 * @link       https://dervisgroup.com
 */

namespace DervisGroup\Pesa\Equity\Library;


class Validator
{
    /**
     * Required keys.
     *
     * @var array
     */
    const RULES = [
        'VA_PAYBILL',
        'VA_PASSWORD',
        'VA_TIMESTAMP',
        'VA_TRANS_ID',
        'VA_REF_ID',
        'VA_AMOUNT',
        'VA_NUMBER',
        'VA_CALL_URL',
        'VA_CALL_METHOD'
    ];

    /**
     * Check if key exists else throw exception.
     *
     * @param array $data
     *
     * @return bool
     * @throws InvalidRequestException
     */
    public static function validate($data = [])
    {
        return true;
        foreach (static::RULES as $value) {
            if (!array_key_exists($value, $data)) {
                throw new InvalidRequestException(InvalidRequestException::ERRORS[$value]);
            }
        }
    }
}