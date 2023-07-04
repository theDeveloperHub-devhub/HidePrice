<?php declare(strict_types=1);

namespace DeveloperHub\HidePrice\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class DropdownOptions implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'pending', 'label' => __('Pending')],
            ['value' => 'answered', 'label' => __('Answered')]
        ];
    }
}
