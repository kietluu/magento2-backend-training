<?php
namespace Bluecom\Freegeoip\Model;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Logger\Monolog as Logger;
use Magento\Customer\Model\Session as Session;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Http\Client as Client;
use Magento\Framework\ObjectManagerInterface;


class Observer implements ObserverInterface
{
    protected $_request;
    protected $_customerSession;
    protected $_logger;
    const URL_GEO_IP_SITE = 'http://freegeoip.net/json/';
    /** @var  ObjectManager */
    private $_objectManager;

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
        Logger $logger,
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        $this->_customerSession = $session;
        $this->_logger = $logger;
        $this->_request = $request;
        $this->_objectManager = $objectManager;
    }

    /**
     * Execute our observer
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        $this->saveVisitorData($observer);
    }

    /**
     * Make a remote call to freegeoip.net to detect country of current customer session and store it into session
     *
     * @return $this
     */
    public function saveVisitorData($observer)
    {
        $clientIP = $this->_request->getClientIp();
        $httpClient = new Client();
        $clientIP = $this->getRandomeIp($clientIP);
        $uri = self::URL_GEO_IP_SITE . $clientIP;

        $httpClient->setUri($uri);
        $httpClient->setOptions(array(
            'timeout' => 30
        ));

        try {
            $response = JsonDecoder::decode($httpClient->send()->getBody());
            $this->_customerSession->setVisitorData($response);
            //save to database
            $currenttime = date('Y-m-d H:i:s');
            $model = $this->_objectManager->create('Bluecom\Freegeoip\Model\Visitor');
            $model->setData('visitor_ip', $response->ip);
            $model->setData('country_code',$response->country_code);
            $model->setData('country_name',$response->country_name);
            $model->setData('region_code',$response->region_code);
            $model->setData('region_name',$response->region_name);
            $model->setData('city',$response->city);
            $model->setData('zip_code',$response->zip_code);
            $model->setData('latitude',$response->latitude);
            $model->setData('longitude',$response->longitude);
            $model->setData('metro_code',$response->metro_code);
            $model->setData('browser', $_SERVER['HTTP_USER_AGENT']);
            $model->setData('os',php_uname());
            $model->setData('created', $currenttime);
            $model->save();

        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }

        return $this;
    }

    private function getRandomeIP($ip){

        $ips[0] = $ip;
        $ips[1] = '107.151.152.218';
        $ips[2] = '165.139.149.169';
        $ips[3] = '195.154.12.164';
        $ips[4] = '158.199.194.160';
        $ips[5] = '210.173.226.58';
        $ips[6] = '157.7.201.140';
        $ips[7] = '106.184.7.45';
        $ips[8] = '158.199.140.91';
        $ips[9] = '195.81.186.116';
        $ips[10] = '193.131.184.102';

        if($ip == '127.0.0.1')
            return $ips[rand(1,10)];
        return $ip;
    }
}