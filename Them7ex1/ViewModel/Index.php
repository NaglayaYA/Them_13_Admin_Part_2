<?php

namespace Perspective\Them7ex1\ViewModel;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $_checkoutSession;


    /**
     * @var \Magento\Sales\Model\Order
     */
    private $_order;

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    private $_orderFactory;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order $order,
        \Magento\Sales\Model\OrderFactory $orderFactory

    ) {

        $this->_checkoutSession = $checkoutSession;
        $this->_order = $order;
        $this->_orderFactory = $orderFactory;
    }

    public function getLast()
    {
        return $this->_checkoutSession->getLastRealOrder();
    }
}
