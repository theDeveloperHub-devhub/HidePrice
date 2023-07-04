<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Controller\Path;

use DeveloperHub\HidePrice\Model\PriceFactory;
use DeveloperHub\HidePrice\Model\PriceRepository;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Area;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\Store;

class Path implements ActionInterface
{
    const EMAIL_TEMPLATE = 'hideprice_emailoptions_send';
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @param RequestInterface $request
     * @param PageFactory $pageFactory
     * @param PriceFactory $priceFactory
     * @param StateInterface $inlineTranslation
     * @param SessionManagerInterface $session
     * @param ManagerInterface $messageManager
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param PriceRepository $priceRepository
     */
    public function __construct(
        RequestInterface $request,
        PageFactory $pageFactory,
        PriceFactory $priceFactory,
        StateInterface $inlineTranslation,
        SessionManagerInterface $session,
        ManagerInterface $messageManager,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        PriceRepository $priceRepository
    ) {
        $this->request = $request;
        $this->pageFactory = $pageFactory;
        $this->priceFactory = $priceFactory;
        $this->inlineTranslation = $inlineTranslation;
        $this->session = $session;
        $this->messageManager = $messageManager;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->priceRepository = $priceRepository;
    }
    public function execute()
    {
        $data = $this->request->getPost();
        $orderInfo = $this->priceFactory->create();
        $orderInfo->setname($data['name']);
        $orderInfo->setemail($data['email']);
        $orderInfo->setPhone($data['number']);
        $orderInfo->setComment($data['comment']);
        $orderInfo->setProductId($data['id']);
        $orderInfo->setPrice($data['price'] . ' this is the requested price of the product');
        $orderInfo->setStatus('pending');
        $this->priceRepository->save($orderInfo);
        $this->sendEmail($orderInfo);
    }
    public function sendEmail($orderInfo)
    {
        $data = $orderInfo->getData();
        $id = $data['product_id'];
        $sendEmailTo = $data['email'];
        $email = 'support@magento.com';
        $name = $data['name'];
        $emailSender = 'admin';
        $finalData = [
            'id' => $id,
            'name' => $name
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
