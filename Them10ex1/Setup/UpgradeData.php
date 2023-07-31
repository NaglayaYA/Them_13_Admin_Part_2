<?php
namespace Perspective\Them10ex1\Setup;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $_postFactory;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    private $_customerFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilderFactory
     */
    private $_searchCriteriaBuilderFactory;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $_customerRepository;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface 
     */
    private $_productRepositoryInterface;

    /**
     * @var \Magento\Review\Model\ResourceModel\Review\Collection 
     */
    private $_collection;

    /**
     * @var  \Magento\Customer\Api\Data\CustomerInterface
     */
    private $_customerInterface;

	public function __construct(
        \Perspective\Them10ex1\Model\PostFactory $postFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface  $productRepositoryInterface,
        \Magento\Review\Model\ResourceModel\Review\Collection  $collection,
         \Magento\Customer\Api\Data\CustomerInterface $customerInterface
        )
	{
		$this->_postFactory = $postFactory;
        $this->_customerFactory = $customerFactory;
        $this->_searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->_customerRepository = $customerRepository;
        $this->_productRepositoryInterface = $productRepositoryInterface;
        $this->_collection = $collection;
        $this->_customerInterface = $customerInterface;
	}
    public function getProduct()
    {
        $sku = "MJ01";
        return $this->_productRepositoryInterface->get($sku);
    }

    public function getCustomer()
    {
        $searchCriteriaBuilder = $this->_searchCriteriaBuilderFactory->create();
        $collection = $this->_customerFactory->create()->getCollection()
            ->load();

        $searchCriteriaBuilder->addFilter(
            CustomerInterface::EMAIL,
            "krishjk64@gmail.com",
            'like'
        );

        $searchCriteria = $searchCriteriaBuilder->create();
        $customerCollection = $this->_customerRepository->getList($searchCriteria);
        
        return $customerCollection->getItems();
    }
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerCollection = $this->getCustomer();
        $productID = $this->getProduct();

        $id= $this->getProduct()->getId(); // product id
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->create("Magento\Catalog\Model\Product")->load($id);
        $rating = $objectManager->get("Magento\Review\Model\ResourceModel\Review\CollectionFactory");
        $collection = $rating->create()
        ->addStatusFilter(
            \Magento\Review\Model\Review::STATUS_APPROVED
        )->addEntityFilter(
            'product',
             $id
        )->setDateOrder();

        $getReview = "";
        foreach ($collection AS $getReviewCollection) {
                    $getReviewTemp = $getReviewCollection->getData("detail");
                    $getReview = $getReviewTemp . $getReview;
                 }

        if ($customerCollection && count($customerCollection) > 0) {
            foreach ($customerCollection AS $customer) {
               $customerName = $customer->getFirstname();
               $customerEmail = $customer->getEmail();
            }
        }

        if (version_compare($context->getVersion(), '1.7.0', '<')) {
        $data = [
            'product_id' => $productID->getId(),
            'text_rev' => $getReview,
            'name_cus'=> $customerName,
            'email'=> $customerEmail,
        ];
        $post = $this->_postFactory->create();
        $post->addData($data)->save();
        }
    }
}