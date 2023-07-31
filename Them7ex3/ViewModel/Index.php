<?php

namespace Perspective\Them7ex3\ViewModel;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Magento\Customer\Model\Session;
use \Magento\Wishlist\Model\Wishlist;
use \Magento\Catalog\Api\ProductRepositoryInterface;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var \Magento\Wishlist\Model\Wishlist
     */
    private $wishlist;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $modelSession;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        \Magento\Wishlist\Model\Wishlist $wishlist,
        \Magento\Customer\Model\Session $modelSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository

    ) {
        $this->wishlist = $wishlist;
        $this->modelSession = $modelSession;
        $this->productRepository = $productRepository;
    }

    public function getCustomerId()
    {
        if (!$this->modelSession->isLoggedIn()) {
            return false;
        }
        return $this->modelSession->getCustomerId();
    }
    public function getWishlistByCustomerId($customerId)
    {
        $wishlist = $this->wishlist->loadByCustomerId($customerId)->getItemCollection();
        return $wishlist;
    }
}
