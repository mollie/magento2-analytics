<?php declare(strict_types=1);
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Model\ResourceModel\Analytics;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mollie\Analytics\Model\Analytics;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Analytics::class, \Mollie\Analytics\Model\ResourceModel\Analytics::class);
    }
}
