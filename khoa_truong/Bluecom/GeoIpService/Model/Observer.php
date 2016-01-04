<?php
namespace Bluecom\GeoIpService\Model;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Logger\Monolog as Logger;
use Magento\Customer\Model\Session as Session;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Http\Client as Client;

class Observer implements ObserverInterface
{
    protected $_request;
    protected $_customerSession;
    protected $_logger;
    const URL_GEO_IP_SITE = 'http://freegeoip.net/json/';
    /**
     * Observer construct method
     *
     * @param Http $request
     * @param \Magento\Customer\Model\Session $session
     * @param Logger $logger
     */
    public function __construct
    (
        Http $request,
        Session $session,
        Logger $logger
    )
    {
        $this->_customerSession = $session;
        $this->_logger = $logger;
        $this->_request = $request;
    }

    /**
     * Execute our observer
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        $this->getCountryFromIp();
    }

    /**
     * Make a remote call to freegeoip.net to detect country of current customer session and store it into session
     *
     * @return $this
     */
    public function getCountryFromIp()
    {
        /* Already call located data */
//        if ($this->_customerSession->getLocated()) {
//            return $this;
//        }

        $clientIP = $this->_request->getClientIp();
        $httpClient = new Client();

        $uri = self::URL_GEO_IP_SITE . $clientIP;

        $httpClient->setUri($uri);
        $httpClient->setOptions(array(
            'timeout' => 30
        ));

        try {
            $response = JsonDecoder::decode($httpClient->send()->getBody());
            $this->_customerSession->setLocationData($response);
            $this->_customerSession->setLocated(true);
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }

        return $this;
    }
}