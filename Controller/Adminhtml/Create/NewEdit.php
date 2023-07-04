<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Controller\Adminhtml\Create;

use DeveloperHub\HidePrice\Model\PriceFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use DeveloperHub\HidePrice\Model\ResourceModel\PriceFactory as ResourcePriceFactory;
class NewEdit extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var PriceFactory
     */
    protected $_priceFactory;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $rawFactory
     * @param PriceFactory $_priceFactory
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        ResourcePriceFactory $price,
        PriceFactory $_priceFactory
    ) {
        $this->pageFactory = $rawFactory;
        $this->price = $price;
        $this->_priceFactory = $_priceFactory;
        parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('DeveloperHub_GiftCard::DeveloperHub');
        $rowId = (int)$this->getRequest()->getParam('id');
        $title = $rowId ? __('Edit Status ') : __('Add Review');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
