<?php
namespace Perspective\Category\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\Data\ProductInterface;
class Category implements ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Api\Data\CategoryInterface
     */


    /**
     * @var Magento\Catalog\Api\CategoryListInterface 
     */
    private $categoryList;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        \Magento\Catalog\Api\CategoryListInterface  $categoryList,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->categoryList = $categoryList;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        
    }

    public function getCategoriesByIds()
    {
        $categoryList = [];

            $searchCriteria = $this->searchCriteriaBuilder->create();
            $categoryList = $this->categoryList->getList($searchCriteria);

        return $categoryList;
    }
    

}