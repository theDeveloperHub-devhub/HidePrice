<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Model\ResourceModel\Price;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use DeveloperHub\HidePrice\Model\ResourceModel\Price;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \DeveloperHub\HidePrice\Model\Price::class,
            Price::class
        );
    }
}

