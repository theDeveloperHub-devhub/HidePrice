<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;

class Customer extends Template
{

    /**
     * @var Session
     */
    private $customerSession;


    /**
     * @param Template\Context $context
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Session $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**w
     * @return array
     */
    public function getCustomer()
    {
        $customerData = $this->customerSession->getCustomer();
        $data = $customerData->getData();
        return $data;
    }
}
