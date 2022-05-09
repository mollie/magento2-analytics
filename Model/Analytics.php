<?php declare(strict_types=1);
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Model;

use Magento\Framework\Model\AbstractModel;
use Mollie\Analytics\Api\Data\AnalyticsInterface;

class Analytics extends AbstractModel implements AnalyticsInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Analytics::class);
    }

    public function getCartId(): ?int
    {
        return $this->_getData(static::CART_ID);
    }

    public function setCartId(int $cartId): AnalyticsInterface
    {
        $this->setData(static::CART_ID, $cartId);

        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->_getData(static::CLIENT_ID);
    }

    public function setClientId(string $clientId): AnalyticsInterface
    {
        $this->setData(static::CLIENT_ID, $clientId);

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->_getData(static::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt): AnalyticsInterface
    {
        $this->setData(static::CREATED_AT, $createdAt);

        return $this;
    }
}

