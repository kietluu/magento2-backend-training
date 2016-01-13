<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 29/12/2015
 * Time: 11:27
 */
namespace Training2\OrderInfo\Block;


class Index extends \Magento\Framework\View\Element\Template
{
	public function defineCountry(){
		$ip = "115.78.167.37";
//		$ip = $this->_request->getClientIp(false);
		$url = 'http://freegeoip.net/json/'.$ip;
		try {
			$json = file_get_contents($url);
			$data = json_decode($json);
			return $data;
		}catch(Exception $e){
			$this->_logger->critical($e->getMessage());
			return false;
		}
	}
}