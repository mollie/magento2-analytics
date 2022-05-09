<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Test\Integration\Observer\CheckoutSubmitAllAfter;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Quote\Api\Data\CartInterface;
use Mollie\Analytics\Api\AnalyticsRepositoryInterface;
use Mollie\Analytics\Observer\CheckoutSubmitAllAfter\SaveAnalyticsCookieValue;
use Mollie\Payment\Test\Integration\IntegrationTestCase;

class SaveAnalyticsCookieValueTest extends IntegrationTestCase
{
    public function testDoesNothingWhenNoCookieIsset(): void
    {
        /** @var SaveAnalyticsCookieValue $instance */
        $instance = $this->objectManager->create(SaveAnalyticsCookieValue::class);

        $quote = $this->objectManager->create(CartInterface::class);
        $quote->setEntityId(999);

        $observer = new \Magento\Framework\Event\Observer();
        $observer->setData('quote', $quote);
        $instance->execute($observer);

        $this->expectException(NoSuchEntityException::class);

        $this->objectManager->create(AnalyticsRepositoryInterface::class)->getByCartId(999);
    }

    public function testSavesTheClientId(): void
    {
        $cookieReaderMock = $this->createMock(CookieManagerInterface::class);
        $cookieReaderMock->method('getCookie')->willReturn('cookievalue');

        /** @var SaveAnalyticsCookieValue $instance */
        $instance = $this->objectManager->create(SaveAnalyticsCookieValue::class, [
            'cookieManager' => $cookieReaderMock,
        ]);

        $quote = $this->objectManager->create(CartInterface::class);
        $quote->setEntityId(999);

        $observer = new \Magento\Framework\Event\Observer();
        $observer->setData('quote', $quote);
        $instance->execute($observer);

        $model = $this->objectManager->create(AnalyticsRepositoryInterface::class)->getByCartId(999);

        $this->assertEquals('cookievalue', $model->getClientId());
    }
}
