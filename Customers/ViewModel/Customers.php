<?php

namespace Perspective\Customers\ViewModel;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Customers implements ArgumentInterface
{
    /**
     * @var Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $_customerRepository;
    /**
     * @var Magento\Customer\Api\Data\CustomerInterface
     */
    private $_customerInterface;
    /** 
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $_productRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;
    /**
     * @var \Magento\Backend\Block\Template\Context
     */
    private $_templateContext;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    private $_customerFactory;
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
        \Magento\Backend\Block\Template\Context $templateContext,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\Data\CustomerInterface $customerInterface,
        private SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,


    ) {
        $this->_productRepository = $productRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_templateContext = $templateContext;
        $this->_customerFactory = $customerFactory;
        $this->_sortOrderBuilder = $sortOrderBuilder;
        $this->_searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->_customerInterface = $customerInterface;
        $this->_customerRepository = $customerRepository;
    }

    public function getCustomerCollection()
    {
        $searchCriteriaBuilder = $this->_searchCriteriaBuilderFactory->create();
        $collection = $this->_customerFactory->create()->getCollection()
            ->load();

        $searchCriteriaBuilder->addFilter(
            CustomerInterface::EMAIL,
            "%gmail.com",
            'like'
        );

        $sortOrder = $this->_sortOrderBuilder
            ->setField('Lastname')  //FIELD_NAME
            ->setDirection(SortOrder::SORT_ASC) // SORT_TYPE
            ->create();

        $searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $searchCriteriaBuilder->create();
        $collection = $this->_customerRepository->getList($searchCriteria);
        return $collection->getItems();
    }
}
