<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 04/01/2016
 * Time: 13:23
 */
namespace Bluecom\IpWithObserver\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event;

class GetCountryFromIp implements ObserverInterface{

	protected $_customerSession;
	protected $_request;

	public function __construct(
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Framework\App\Request\Http $request
	)
	{
		$this->_customerSession = $customerSession;
		$this->_request = $request;
	}

	/**
	 * @param Observer $observer
	 * @return void
	 */
	public function execute(\Magento\Framework\Event\Observer $observer)
	{

		$clientIP = "115.78.167.37";
//		$clientIP = $this->_request->getClientIp();

        $httpClient = new \Zend\Http\Client();

        $uri = 'http://freegeoip.net/json/' . $clientIP;

        $httpClient->setUri($uri);
        $httpClient->setOptions(array(
	        'timeout' => 30
        ));
        try {
	        $response = \Zend\Json\Decoder::decode($httpClient->send()->getBody());
	        $this->_customerSession->setLocationData($response);
	        $this->_customerSession->setLocated(true);
        } catch (\Exception $e) {
	        $this->_logger->critical($e);
        }
        return $this;
	}
}