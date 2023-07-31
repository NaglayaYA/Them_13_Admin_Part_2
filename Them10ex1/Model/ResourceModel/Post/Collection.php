<?php
namespace Perspective\Them10ex1\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perspective\Them10ex1\Model\Post', 'Perspective\Them10ex1\Model\ResourceModel\Post');
    }
}
