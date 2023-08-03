<?php
namespace Perspective\Them11ex1\Model\ResourceModel\Contactdetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'perspective_them11ex1_contactdetails_collection';
    protected $_eventObject = 'contactdetails_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perspective\Them11ex1\Model\Contactdetails', 'Perspective\Them11ex1\Model\ResourceModel\Contactdetails');
    }
}
