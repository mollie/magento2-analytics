<?php
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Mollie\Analytics\Api\AnalyticsRepositoryInterface;
use Mollie\Analytics\Api\Data\AnalyticsInterface;
use Mollie\Analytics\Api\Data\AnalyticsInterfaceFactory;
use Mollie\Analytics\Model\ResourceModel\Analytics as ResourceAnalytics;

class AnalyticsRepository implements AnalyticsRepositoryInterface
{
    /**
     * @var ResourceAnalytics
     */
    private $resource;

    /**
     * @var AnalyticsInterfaceFactory
     */
    private $analyticsFactory;

    /**
     * @var DateTime
     */
    private $dateTime;

    public function __construct(
        ResourceAnalytics $resource,
        AnalyticsInterfaceFactory $analyticsFactory,
        DateTime $dateTime
    ) {
        $this->resource = $resource;
        $this->analyticsFactory = $analyticsFactory;
        $this->dateTime = $dateTime;
    }

    public function getById(int $id): AnalyticsInterface
    {
        $analytics = $this->analyticsFactory->create();
        $this->resource->load($analytics, $id);
        if (!$analytics->getId()) {
            throw new NoSuchEntityException(__('Analytics with id "%1" does not exist.', $id));
        }

        return $analytics;
    }

    public function getByCartId(int $cartId): AnalyticsInterface
    {
        $analytics = $this->analyticsFactory->create();
        $this->resource->load($analytics, $cartId, 'cart_id');
        if (!$analytics->getId()) {
            throw new NoSuchEntityException(__('Analytics with cartId "%1" does not exist.', $cartId));
        }

        return $analytics;
    }

    public function save(AnalyticsInterface $model): AnalyticsInterface
    {
        if (!$model->getEntityId()) {
            $model->setCreatedAt($this->dateTime->gmtDate('Y-m-d H:i:s'));
        }

        try {
            $this->resource->save($model);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the analytics: %1',
                $exception->getMessage()
            ));
        }

        return $model;
    }
}
