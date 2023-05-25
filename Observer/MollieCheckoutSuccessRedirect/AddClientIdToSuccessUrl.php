<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Observer\MollieCheckoutSuccessRedirect;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddClientIdToSuccessUrl implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    public function execute(Observer $observer): void
    {
        $clientId = $this->request->getParam('clientId');
        if (!$clientId) {
            return;
        }

        /** @var DataObject $redirect */
        $redirect = $observer->getData('redirect');
        $query = $redirect->getData('query');
        $query['clientId'] = $clientId;

        $redirect->setData('query', $query);
    }
}
