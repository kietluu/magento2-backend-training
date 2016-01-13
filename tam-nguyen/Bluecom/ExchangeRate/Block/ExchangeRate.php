<?php
namespace Bluecom\ExchangeRate\Block;

use Magento\Framework\View\Element\Context;
use Magento\Framework\HTTP\ZendClientFactory;

class ExchangeRate extends \Magento\Framework\View\Element\AbstractBlock {
	
	protected $_clientUrl;
	const Rate_URL = 'http://api.fixer.io/latest?base=USD';

	public function __construct(Context $context, ZendClientFactory $clientUrl, array $data){
    	$this->_clientUrl = $clientUrl;
    	parent::__construct($context, $data);
	}
	
	public function _toHtml(){
		$client = $this->_clientUrl->create(['uri' => self::Rate_URL]);
	    try{
	    	$result = $client->request();
	    	$rate = json_decode($result->getBody());
            if(isset($rate->rates->EUR)){
            	 return sprintf('<div style="display: inline-block;">1 USD = %s EUR</div>', $rate->rates->EUR);
            }
	    }
	    catch(\Exception $e){
	    	
	    }
	    
	}
}
