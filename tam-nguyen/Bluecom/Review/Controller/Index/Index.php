<?php
namespace Bluecom\Review\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends  \Magento\Framework\App\Action\Action {

    protected $resultPageFactory;

	public function __construct( Context $Context, PageFactory $PageFactory ){
    	$this->resultPageFactory = $PageFactory;    
		parent::__construct($Context);
	}


	public function execute(){
      $result = $this->resultPageFactory->create();
      return $result;
	}
}

?>