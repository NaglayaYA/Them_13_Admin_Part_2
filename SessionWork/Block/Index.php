<?php
namespace Perspective\SessionWork\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
* @var \Magento\Catalog\Model\Session
*/
private $_catalogSession;

/**
* @var \Magento\Customer\Model\Session
*/
private $_customerSession;

/**
* @var \Magento\Checkout\Model\Session
*/
private $_checkoutSession;

/**
* @param \Magento\Framework\View\Element\Template\Context $context
* @param array $data
*/
public function __construct(

\Magento\Framework\View\Element\Template\Context $context,
\Magento\Catalog\Model\Session $catalogSession,
\Magento\Customer\Model\Session $customerSession,
\Magento\Checkout\Model\Session $checkoutSession,

array $data = []
) {
$this->_checkoutSession = $checkoutSession;
$this->_catalogSession = $catalogSession;
$this->_customerSession = $customerSession;


parent::__construct($context, $data);
}

public function _prepareLayout()
{


return parent::_prepareLayout();
}

public function getCatalogSession()
{


return $this->_catalogSession;
}

public function getCustomerSession()
{

return $this->_customerSession;

}

public function getCheckoutSession()
{

return $this->_checkoutSession;

}
}
