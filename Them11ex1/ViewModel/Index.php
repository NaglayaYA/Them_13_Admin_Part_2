<?php
namespace Perspective\Them11ex1\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Perspective\Them11ex1\Model\ContactdetailsFactory;
class Index implements ArgumentInterface
{
    private $contactDetailsFactory;


    public function __construct(

        ContactdetailsFactory $contactDetailsFactory,
    ) {

        $this->contactDetailsFactory = $contactDetailsFactory;
    }


    public function getPostCollection()
    {
        $post = $this->contactDetailsFactory->create();
        $collection = $post->getCollection();


        return $collection;
    }
}
