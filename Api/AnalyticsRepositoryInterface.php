<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Api;

use Mollie\Analytics\Api\Data\AnalyticsInterface;

interface AnalyticsRepositoryInterface
{
    /**
     * @param int $id
     * @return AnalyticsInterface
     */
    public function getById(int $id): AnalyticsInterface;

    /**
     * @param int $cartId
     * @return AnalyticsInterface
     */
    public function getByCartId(int $cartId): AnalyticsInterface;

    /**
     * @param AnalyticsInterface $model
     * @return AnalyticsInterface
     */
    public function save(AnalyticsInterface $model): AnalyticsInterface;
}
