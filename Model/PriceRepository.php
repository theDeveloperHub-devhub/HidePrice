<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Model;

use DeveloperHub\HidePrice\Api\Data\HidePriceInterface;
use DeveloperHub\HidePrice\Model\ResourceModel\Price;
use DeveloperHub\HidePrice\Api\HidePriceRepositoryInterface;

class PriceRepository implements HidePriceRepositoryInterface
{

    /**
     * @var Price
     */
    private $priceResourceModel;

    /**
     * @param HidePriceInterface $priceResource
     * @param Price $priceResourceModel
     */
    public function __construct(
        HidePriceInterface $priceResource,
        Price $priceResourceModel
    ) {
        $this->orderResource = $priceResource;
        $this->priceResourceModel = $priceResourceModel;
    }

    /**
     * @param HidePriceInterface $sendRequest
     * @return HidePriceInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(HidePriceInterface $sendRequest)
    {
        $this->priceResourceModel->save($sendRequest);
        return $sendRequest;
    }
}
