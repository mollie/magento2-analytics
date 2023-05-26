<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Service\Order\TransactionPart;

use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Mollie\Payment\Service\Order\TransactionPartInterface;

class AddClientIdToRedirectUrl implements TransactionPartInterface
{
    /**
     * @var CookieManagerInterface
     */
    private $cookieManager;

    public function __construct(
        CookieManagerInterface $cookieManager
    ) {
        $this->cookieManager = $cookieManager;
    }

    public function process(OrderInterface $order, $apiMethod, array $transaction)
    {
        $cookie = $this->cookieManager->getCookie('_ga');
        if (!$cookie) {
            return $transaction;
        }

        $clientId = $this->getClientIdFrom($cookie);
        $append = '?clientId=' . $clientId;
        if (strstr($transaction['redirectUrl'], '?') !== false) {
            $append = '&clientId=' . $clientId;
        }

        $transaction['redirectUrl'] .= $append;

        return $transaction;
    }

    private function getClientIdFrom(string $cookie): string
    {
        $parts = explode('.', $cookie);

        array_shift($parts);
        array_shift($parts);

        return implode('.', $parts);
    }
}
