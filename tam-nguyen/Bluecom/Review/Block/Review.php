<?php
namespace Bluecom\Review\Block;
use Magento\Framework\View\Element\Template\Context;

class Review extends \Magento\Framework\View\Element\Template {

	public function _prepareLayout() {
	    return parent::_prepareLayout();
	}

	public function __construct(Context $content, array $data = []){
		parent::__construct($content, $data);
	}
    
}

?>