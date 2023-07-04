<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Controller\Adminhtml\Create;

use DeveloperHub\HidePrice\Model\ResourceModel\Price\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class MassDelete extends Action
{
    /** @var ResultFactory */
    protected $resultFactory;


    /** @var CollectionFactory */
    private $collectionFactory;

    /**
     * @param Context $context
     * @param ResultFactory $resultFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        if ($ids === null) {
            $collection = $this->collectionFactory->create();
        } else {
            $collection = $this->collectionFactory->create()
                ->addFieldToFilter('id', ['in' => $ids]);
        }
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            $item->delete();
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 tab(s) have been deleted', $collectionSize));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/create');
    }
}
