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

namespace DervisGroup\Pesa\Mpesa\Listeners;

use DervisGroup\Pesa\Mpesa\Events\StkPushPaymentSuccessEvent;

/**
 * Class StkPaymentSuccessful
 * @package DervisGroup\Pesa\Listeners
 */
class StkPaymentSuccessful
{
    /**
     * @param StkPushPaymentSuccessEvent $event
     */
    public function handle(StkPushPaymentSuccessEvent $event)
    {
        /** @var \DervisGroup\Pesa\Mpesa\Database\Entities\MpesaStkCallback $stk */
        $stk = $event->stk_callback;
        $stk->request()->update(['status' => 'Paid']);
    }
}
