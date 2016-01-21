<?php
namespace Bluecom\FreeGeoIp\Model;

use Magento\Framework\Model\AbstractModel;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Http\Client as Client;

class Country extends AbstractModel
{
    protected $_request;
    const URL_GEO_IP_SITE = 'http://freegeoip.net/json/';
    const URL_IP_SITE = 'http://ipecho.net/plain';
    /**
     * Observer construct method
     *
     * @param Http $request
     */
    public function __construct
    (
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->_request = $request;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Get country from IP
     *
     * @return $this
     */
    public function getCountry()
    {
//        $clientIP = $this->_request->getClientIp();
        $clientIP = file_get_contents(self::URL_IP_SITE);
        $httpClient = new Client();

        $uri = self::URL_GEO_IP_SITE . $clientIP;

        $httpClient->setUri($uri);
        $httpClient->setOptions(array(
            'timeout' => 30
        ));

        try {
            $response = JsonDecoder::decode($httpClient->send()->getBody());
            if (is_object($response) && $response->country_name)
                return $response->country_name;
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}