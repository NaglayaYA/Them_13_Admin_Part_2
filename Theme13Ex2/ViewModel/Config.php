<?php
namespace Perspective\Theme13Ex2\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template\Context;
use Perspective\Theme13Ex2\Helper\Data;

class Config implements ArgumentInterface
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var \Magento\Framework\Registry
     */
    private $_registry;

    /**
     * @var \Magento\CatalogInventory\Model\Stock\StockItemRepository
     */
    private $_stockItemRepository;

    public function __construct(
        Context $context, 
        Data $helper,
        \Magento\Framework\Registry $registry,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository
    )
    {
        $this->helper = $helper;
        $this->_registry = $registry;
        $this->_stockItemRepository = $stockItemRepository;        
    }

/**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }

    // --- --- Get info --- --- //

    public function getX()
    {
        return $this->helper->getX();
    }

    //--- --- CurrentProduct --- ---//

    public function getCurrentProduct()
    {
    return $this->_registry->registry('current_product');
    }

    public function getCurrentCategory()
    {
    return $this->_registry->registry('current_category');
    }

    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }
}