<?php

namespace Perspective\Them11ex1\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contactdetails extends AbstractDb
{
    public function _construct()
    {

        $this->_init("consultations", 'id');
    }
}