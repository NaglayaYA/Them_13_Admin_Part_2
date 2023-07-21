<?php

namespace Perspective\Them5ex1\ViewModel;

class Them5ex1 implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $_categoryCollectionFactory;
    protected $_productRepository;
    protected $_registry;
    protected $_productIds;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $_collectionFactory;

    /**
     * @var \Magento\Catalog\Model\Product\Attribute\Source\Status
     */
    private $_status;

    /**
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    private $_visibility;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $status,
        \Magento\Catalog\Model\Product\Visibility $visibility,
        array $data = []
    ) {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_productRepository = $productRepository;
        $this->_registry = $registry;
        $this->_collectionFactory = $collectionFactory;
        $this->_status = $status;
        $this->_visibility = $visibility;
    }

    /**
     * Get category collection
     *
     * @param bool $isActive
     * @param bool|int $level
     * @param bool|string $sortBy
     * @param bool|int $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection or array
     */

    /* 5.1.1 */

    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');        
        
        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }
                
        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }
        
        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }
        
        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize); 
        }    
        
        return $collection;
    }
    
    public function getProductById($id)
    {        
        return $this->_productRepository->getById($id);
    }
    
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }  

    /* 5.1.2 */

    public function getAllActiveCatalogRule()
    {
        $catalogActiveRule = $this->_categoryCollectionFactory->create()->addFieldToFilter('is_active', 1);

        return $catalogActiveRule;
    }

   /* 5.1.3 */
    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }
    /* 5.1.4 */
    public function getProductCollection()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('status', ['in' => $this->_status->getVisibleStatusIds()]);
        $collection->setVisibility($this->_visibility->getVisibleInSiteIds());
        return $collection;
    }

}
