<?php declare(strict_types=1);
/*
 * Copyright Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mollie\Analytics\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Analytics extends AbstractDb
{
    /** @var string Main table name */
    const MAIN_TABLE = 'mollie_analytics_analytics';

    /** @var string Main table primary key field name */
    const ID_FIELD_NAME = 'entity_id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
