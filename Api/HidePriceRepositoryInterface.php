<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Api;

use DeveloperHub\HidePrice\Api\Data\HidePriceInterface;

interface HidePriceRepositoryInterface
{
    /**
     * @param HidePriceInterface $sendRequest
     * @return mixed
     */
    public function save(HidePriceInterface $sendRequest);
}
