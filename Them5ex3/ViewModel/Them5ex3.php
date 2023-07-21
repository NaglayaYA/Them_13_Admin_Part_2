<?php

namespace Perspective\Them5ex3\ViewModel;

use Magento\Catalog\Model\Product\Visibility;

class Them5ex3 implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $_collectionFactory;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    private $_categoryFactory;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_categoryFactory = $categoryFactory;
    }
    public function getProductCollectionByCategories()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*')
            ->addAttributeToFilter('price', array('from' => 50))
            ->addAttributeToFilter('price', array('to' => 60));
        $collection->setVisibility([Visibility::VISIBILITY_BOTH]);
        $collection->addCategoriesFilter(['in' => [23]]);


        return $collection;
    }
    public function getCategoryName($categoryId)
    {
        $category = $this->_categoryFactory->create()->load($categoryId);
        $categoryName = $category->getName();
        return $categoryName;
    }
}
