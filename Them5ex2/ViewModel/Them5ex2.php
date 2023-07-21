<?php

namespace Perspective\Them5ex2\ViewModel;

class Them5ex2 implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\CatalogInventory\Model\Stock\StockItemRepository
     */
    private $_stockItemRepository;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface 
     */
    private $_productRepository;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    private $_image;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $_productFactory;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    private $_customerFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    private $_ordercollectionFactory;

    /**
     * @var \Magento\Customer\Model\ResourceModel\Group\Collection
     */
    private $_cutomerGroup;

    /**
     * @var \Magento\Payment\Helper\Data
     */
    private $_helperData;

    /**
     * @var \Magento\Shipping\Model\Config\Source\Allmethods
     */
    private $_allmethods;

    public function __construct(
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface  $productRepository,
        \Magento\Catalog\Helper\Image $image,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $ordercollectionFactory,
        \Magento\Customer\Model\ResourceModel\Group\Collection $cutomerGroup,
        \Magento\Payment\Helper\Data $helperData,
        \Magento\Shipping\Model\Config\Source\Allmethods $allmethods
    ) {
        $this->_stockItemRepository = $stockItemRepository;
        $this->_productRepository = $productRepository;
        $this->_image = $image;
        $this->_productFactory = $productFactory;
        $this->_customerFactory = $customerFactory;
        $this->_ordercollectionFactory = $ordercollectionFactory;
        $this->_cutomerGroup = $cutomerGroup;
        $this->_helperData = $helperData;
        $this->_allmethods = $allmethods;
    }
    //5.2.1
    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }
    //5.2.2
    public function getProductImageUrl($id)
    {
        $product = $this->_productFactory->create()->load($id);
        $url = $this->_image->init($product, 'product_thumbnail_image')->getUrl();
        return $url;
    }

    public function getImageOriginalWidth($product, $imageId, $attributes = [])
    {
        return $this->_image->init($product, $imageId, $attributes)->getWidth();
    }

    public function getImageOriginalHeight($product, $imageId, $attributes = [])
    {
        return $this->_image->init($product, $imageId, $attributes)->getHeight();
    }
    //5.2.3
    public function getCustomerCollection()
    {
        $collection = $this->_customerFactory->create()->getCollection()
            ->load();
        return $collection;
    }
    //5.2.4
    public function getOrderCollection()
    {
        $collection = $this->_ordercollectionFactory->create()
            ->addAttributeToSelect('*')
            ->setOrder(
                'created_at',
                'desc'
            );

        return $collection;
    }
    //5.2.5
    public function getCustomerGroups()
    {
        $customerGroups = $this->_cutomerGroup->toOptionArray();
        array_unshift($customerGroups, array('value' => '', 'label' => 'Any'));
        return $customerGroups;
    }
    //5.2.6
    public function getAllPaymentMethodsList()
    {
        return $this->_helperData->getPaymentMethodList();
    }
    //5.2.7
    public function getAllShippingMethods()
    {
        return $this->_allmethods->toOptionArray();
    }
}
