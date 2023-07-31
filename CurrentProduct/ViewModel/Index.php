<?php

namespace Perspective\CurrentProduct\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    protected $_registry;
    /**
     * @var \Magento\Catalog\Helper\Data
     */
    private $helperData;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Helper\Data $helperData,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->helperData = $helperData;
    }

    public function getCurrentProduct()
    {
        return $this->helperData->getProduct();
    }
    public function getCurrentCategory()
    {
        return $this->helperData->getCategory();
    }
}
