<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Api\Data;

interface AnalyticsInterface
{
    const ENTITY_ID = 'entity_id';
    const CART_ID = 'cart_id';
    const CLIENT_ID = 'client_id';
    const CREATED_AT = 'created_at';

    /**
     * @return int|null
     */
    public function getEntityId();

    /**
     * @param string $entityId
     * @return \Mollie\Analytics\Api\Data\AnalyticsInterface
     */
    public function setEntityId($entityId);

    /**
     * @return int|null
     */
    public function getCartId(): ?int;

    /**
     * @param int $cartId
     * @return \Mollie\Analytics\Api\Data\AnalyticsInterface
     */
    public function setCartId(int $cartId): self;

    /**
     * @return string|null
     */
    public function getClientId(): ?string;

    /**
     * @param string $clientId
     * @return \Mollie\Analytics\Api\Data\AnalyticsInterface
     */
    public function setClientId(string $clientId): self;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @return \Mollie\Analytics\Api\Data\AnalyticsInterface
     */
    public function setCreatedAt(string $createdAt): self;
}
