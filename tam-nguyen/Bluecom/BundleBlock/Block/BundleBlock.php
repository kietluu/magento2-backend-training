<?php
namespace Bluecom\BundleBlock\Block;

class BundleBlock extends \Magento\Framework\View\Element\AbstractBlock {
	
	public function _toHtml(){
		return "<span>Hello world</span>";
	}
}

?>