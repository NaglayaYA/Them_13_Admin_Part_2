<?php
namespace Perspective\Them10ex1\Model;

class Post  extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {

        $this->_init('Perspective\Them10ex1\Model\ResourceModel\Post');
    }
}
