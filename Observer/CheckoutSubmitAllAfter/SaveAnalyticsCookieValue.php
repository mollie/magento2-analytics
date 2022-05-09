<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Observer\CheckoutSubmitAllAfter;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Mollie\Analytics\Api\AnalyticsRepositoryInterface;
use Mollie\Analytics\Api\Data\AnalyticsInterface;
use Mollie\Analytics\Api\Data\AnalyticsInterfaceFactory;

class SaveAnalyticsCookieValue implements ObserverInterface
{
    /**
     * @var CookieManagerInterface
     */
    private $cookieManager;

    /**
     * @var AnalyticsInterfaceFactory
     */
    private $analyticsFactory;

    /**
     * @var AnalyticsRepositoryInterface
     */
    private $repository;

    public function __construct(
        CookieManagerInterface $cookieManager,
        AnalyticsInterfaceFactory $analyticsFactory,
        AnalyticsRepositoryInterface $repository
    ) {
        $this->cookieManager = $cookieManager;
        $this->analyticsFactory = $analyticsFactory;
        $this->repository = $repository;
    }

    public function execute(Observer $observer)
    {
        $quote = $observer->getData('quote');
        $cartId = $quote->getEntityId();

        $cookie = $this->cookieManager->getCookie('_ga');
        if (!$cookie) {
            return;
        }

        /** @var AnalyticsInterface $model */
        $model = $this->analyticsFactory->create();
        $model->setClientId($cookie);
        $model->setCartId($cartId);

        $this->repository->save($model);
    }
}
