<?php

namespace Perspective\Helloworld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action

{


        protected $helperData;


        public function __construct(

               \Magento\Framework\App\Action\Context $context,

               \Perspective\Helloworld\Helper\Data $helperData


        )

        {

               $this->helperData = $helperData;

               return parent::__construct($context);

        }


        public function execute()

        {


               // TODO: Implement execute() method.


               echo $this->helperData->getGeneralConfig('enable');

               echo $this->helperData->getGeneralConfig('display_text');

               exit();


        }

}
