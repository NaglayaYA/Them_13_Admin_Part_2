<?php

namespace Perspective\Them13ex1\ViewModel;


use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Perspective\Them13ex1\Helper\Data;

class Them13ex1 implements ArgumentInterface
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

    /**
     * @var \Magento\Directory\Model\CurrencyFactory
     */
    private $currencyFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        Data $helper,
        \Magento\Framework\Registry $registry,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_registry = $registry;
        $this->_stockItemRepository = $stockItemRepository;
        $this->currencyFactory = $currencyFactory;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

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
    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }

    /**
     * @return bool
     */
    public function isUAN()
    {
        return $this->helper->isUAN();
    }

    public function getCourseUAN()
    {
        return $this->helper->getCourseUAN();
    }

    /**
     * @return bool
     */
    public function isEUR()
    {
        return $this->helper->isEUR();
    }

    public function getCourseEUR()
    {
        return $this->helper->getCourseEUR();
    }

    /**
     * @return bool
     */
    public function isUSD()
    {
        return $this->helper->isUSD();
    }

    public function getCourseUSD()
    {
        return $this->helper->getCourseUSD();
    }

    public function convertPrice($price, $currencyCodeFrom, $currencyCodeTo)
    {
        $rate = $this->currencyFactory->create()
            ->load($currencyCodeFrom)
            ->getAnyRate($currencyCodeTo);

        $convertedPrice = $price * $rate;

        return $convertedPrice;
    }
}
