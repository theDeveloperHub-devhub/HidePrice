<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_CONFIG_ENABLE = 'price/hide_price/enable';

    /**
     * @param $storeId
     * @return mixed
     */
    public function getConfigFieldEnable($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CONFIG_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
