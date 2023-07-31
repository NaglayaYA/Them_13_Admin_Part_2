<?php

namespace Perspective\Them7ex2\ViewModel;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
  protected $_cart;
  protected $_checkoutSession;

  public function __construct(
    \Magento\Backend\Block\Template\Context $context,

    \Magento\Checkout\Model\Session $checkoutSession,
    array $data = []
  ) {

    $this->_checkoutSession = $checkoutSession;
  }



  public function getCheckoutSession()
  {
    return $this->_checkoutSession;
  }
}
