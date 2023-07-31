<?php

namespace Perspective\Them10ex1\ViewModel;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    /**
     * @var \Perspective\Them10ex1\Model\PostFactory
     */
    private $_postFactory;


    /**
     * @var  \Magento\Framework\Api\SearchCriteriaBuilderFactory
     */
    private $_searchCriteriaBuilderFactory;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    private $_customerFactory;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $_customerRepository;

    /**
     * @var \Perspective\WareHouse\Model\ResourceModel\Post\CollectionFactory
     */
    private $_collectionFactory;

    /**
     * @var \Magento\Catalog\Model\ProductCategoryList
     */
    private $_productCategory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $_productFactory;

    public function __construct(

        \Perspective\Them10ex1\Model\PostFactory $postFactory,
        \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Perspective\Them10ex1\Model\ResourceModel\Post\CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\ProductCategoryList $productCategory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {

        $this->_postFactory = $postFactory;
        $this->_searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->_customerFactory = $customerFactory;
        $this->_customerRepository = $customerRepository;
        $this->_collectionFactory = $collectionFactory;
        $this->_productCategory = $productCategory;
        $this->_productFactory = $productFactory;
    }

    public function getPostCollection()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addFieldToFilter('name_cus',['like'=>['Kristina']]);
        return $collection;
    }
    public function getCollectionId()
    {
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        return $collection;
    }
    public function getProductImages($productId) {
        $_product = $this->_productFactory->create()->load($productId);
        $productImages = $_product->getMediaGalleryImages();
        return $productImages;
    }
}
