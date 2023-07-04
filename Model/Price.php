<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Model;

use DeveloperHub\HidePrice\Api\Data\HidePriceInterface;
use DeveloperHub\HidePrice\Model\ResourceModel\Price as CustomTabsResourceModel;
use Magento\Framework\Model\AbstractExtensibleModel;

class Price extends AbstractExtensibleModel implements HidePriceInterface
{

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(CustomTabsResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return parent::getData(self::ID);
    }

    /**
     * @param $id
     * @return Price|int
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return parent::getData(self::COMMENT);
    }

    /**
     * @param $comment
     * @return Price|mixed
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * @return mixed|null
     */
    public function getemail()
    {
        return parent::getData(self::EMAIL);
    }

    /**
     * @param $email
     * @return Price|mixed
     */
    public function setemail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @return mixed|null
     */
    public function getname()
    {
        return parent::getData(self::NAME);
    }

    /**
     * @param $name
     * @return Price|mixed
     */
    public function setname($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return mixed|null
     */
    public function getStatus()
    {
        return parent::getData(self::STATUS);
    }

    /**
     * @param $status
     * @return Price|mixed
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return mixed|null
     */
    public function getPhone()
    {
        return parent::getData(self::PHONE);
    }

    /**
     * @param $phone
     * @return Price|mixed
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }


    /**
     * @return mixed|null
     */
    public function getProductId()
    {
        return parent::getData(self::PRODUCT_ID);
    }

    /**
     * @param $productId
     * @return Price|mixed
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    public function getPrice()
    {
        return parent::getData(self::PRICE);
    }

    /**
     * @param $price
     * @return Price|mixed
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }
}
