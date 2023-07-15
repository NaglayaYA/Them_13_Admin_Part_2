<?php

namespace Perspective\Simple\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Simple implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
  /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * @var Magento\Framework\Api\SortOrderBuilder
     */
    private $_sortOrderBuilder;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilderFactory
     */
    private $_searchCriteriaBuilderFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context

     */
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        private SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {
        $this->_productRepository = $productRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_sortOrderBuilder = $sortOrderBuilder;
        $this->_searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;


    }


    public function getProductByLetter()
    {
        $searchCriteriaBuilder = $this->_searchCriteriaBuilderFactory->create();
        $searchCriteriaBuilder->addFilter(
            ProductInterface::NAME,
            "P%",
            'like'
        );
        $searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            59,
            'gt'
        );

        $searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            76,
            'lt'
        );
        $sortOrder = $this->_sortOrderBuilder
            ->setField('price')  //FIELD_NAME
            ->setDirection(SortOrder::SORT_DESC) // SORT_TYPE
            ->create();

            
            
            
        $searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $searchCriteriaBuilder->create();
        $searchCriteria->setPageSize(6);
        $productCollection = $this->_productRepository->getList($searchCriteria);
        

        return $productCollection->getItems();
    }
}