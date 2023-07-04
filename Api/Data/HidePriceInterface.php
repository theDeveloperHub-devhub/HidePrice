<?php declare(strict_types = 1);

namespace DeveloperHub\HidePrice\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
interface HidePriceInterface extends ExtensibleDataInterface
{
    const ID = 'id';

    const NAME = 'name';
    const EMAIL = 'email';

    const PRICE = 'price';

    const STATUS = 'status';

    const COMMENT = 'comment';

    const PHONE = 'number';

    const PRODUCT_ID = 'product_id';

    /**
     * @return string
     */
    public function getId();

    /**
     * @param $id
     * @return int
     */
    public function setId($id);


    /**
     * @return string
     */
    public function getComment();

    /**
     * @param $comment
     * @return mixed
     */
    public function setComment($comment);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getemail();

    /**
     * @param $email
     * @return mixed
     */
    public function setemail($email);

    /**
     * @return mixed
     */
    public function getname();

    /**
     * @param $name
     * @return mixed
     */
    public function setname($name);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param $phone
     * @return mixed
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getProductId();

    /**
     * @param $productId
     * @return mixed
     */
    public function setProductId($productId);

    /**
     * @return mixed
     */
    public function getPrice();

    /**
     * @param $price
     * @return mixed
     */
    public function setPrice($price);

}
