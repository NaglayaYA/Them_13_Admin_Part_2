<?php
namespace Perspective\Them7ex4\ViewModel;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Backend\Model\Session\Quote as BackendModelSession;
class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $backendModelSession;
 
    public function __construct(
           Context $context,
           BackendModelSession $backendModelSession
       )
       {
           $this->backendModelSession = $backendModelSession;
           
       }
    
   
    
    public function getBackendQuote(){
    $quote = $this->backendModelSession->getQuote();
    return $quote;
    }
  
}
