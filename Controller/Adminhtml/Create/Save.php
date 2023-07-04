<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Controller\Adminhtml\Create;

use DeveloperHub\HidePrice\Model\PriceFactory;
use DeveloperHub\HidePrice\Model\PriceRepository;
use DeveloperHub\HidePrice\Model\ResourceModel\Price\CollectionFactory;
use DeveloperHub\HidePrice\Model\ResourceModel\PriceFactory as ResourcePriceFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Area;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\Store;

class Save extends Action
{
    const EMAIL_TEMPLATE = 'price_send';
    /**
     * @var PriceFactory
     */
    protected $_priceFactory;

    protected $sessionManager;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param Context $context
     * @param PriceFactory $priceFactory
     * @param ResourcePriceFactory $price
     * @param SessionManagerInterface $sessionManager
     * @param PriceRepository $priceRepository
     * @param StateInterface $inlineTranslation
     * @param ManagerInterface $messageManager
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        PriceFactory $priceFactory,
        ResourcePriceFactory $price,
        SessionManagerInterface $sessionManager,
        PriceRepository $priceRepository,
        StateInterface $inlineTranslation,
        ManagerInterface $messageManager,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        CollectionFactory $collectionFactory
    ) {
        $this->_priceFactory = $priceFactory;
        $this->price = $price;
        $this->sessionManager = $sessionManager;
        $this->priceRepository = $priceRepository;
        $this->messageManager = $messageManager;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = $data['id'];
        if ($data['status'] == 'answered') {
            $collection = $this->_priceFactory->create();
            $this->price->create()->load($collection, $id);
            $orderData = $collection->setData('status', 'answered');
            $this->priceRepository->save($orderData);
            $price = $data['price'];
            $this->sendEmail($orderData, $price);
        } else {
            $collection = $this->_priceFactory->create();
            $this->price->create()->load($collection, $id);
            $statusData = $data['status'];
            $orderData = $collection->setData('status', $statusData);
            $this->priceRepository->save($orderData);
        }
        $this->_redirect('developer_hub/create/create');
    }
    public function sendEmail($orderData, $price)
    {
        $data = $orderData->getData();
        $id = $data['product_id'];
        $sendEmailTo = $data['email'];
        $email = 'support@magento.com';
        $name = $data['name'];
        $emailSender = 'admin';
        $finalData = [
            'id' => $id,
            'name' => $name,
            'price' => $price
        ];
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml($emailSender),
                'email' => $this->escaper->escapeHtml($email),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier(self::EMAIL_TEMPLATE)
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars(['data' => $finalData])
                ->setFromByScope($sender)
                ->addTo($sendEmailTo)
                ->getTransport();
            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __($e->getMessage())
            );
        } finally {
            $this->inlineTranslation->resume();
        }
    }
}
