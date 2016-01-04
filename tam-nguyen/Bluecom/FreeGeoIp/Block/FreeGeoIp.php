<?php
namespace Bluecom\FreeGeoIp\Block;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template\Context;

class FreeGeoIp extends \Magento\Framework\View\Element\Template {
	
    protected $session;

	public function _prepareLayout() {
	    return parent::_prepareLayout();
	}
    
    public function __construct(
    	Session $customerSession,
        Context $context,
        array $data = []
    ) {
        $this->session = $customerSession;
        parent::__construct($context, $data);
    }

    public function getIp(){
        $IpAddress = $this->getIpAddress();
        $url = 'http://freegeoip.net/json/'.$IpAddress;
        $headers = ["Content-Type: application/json"];

        $cSession = curl_init(); 
		curl_setopt($cSession,CURLOPT_URL, $url);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		$result = json_decode($result);
		$country = $result->country_name;
		curl_close($cSession);
    	return $country;
    }
    public function getIpAddress(){
        $ipaddress = '115.78.167.37';
        if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1')
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']!= '127.0.0.1')
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if( isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED']!= '127.0.0.1')
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if( isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR']!= '127.0.0.1')
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if( isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED']!= '127.0.0.1')
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!= '127.0.0.1')
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        return $ipaddress;
    }

}

?>