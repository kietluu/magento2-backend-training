<?php
namespace TanDinh\FreeGeoIp\Block;
use Magento\Framework\View\Element\Template\Context;

class Country extends \Magento\Framework\View\Element\Template
{
    /**
     * Country constructor.
     */
    public function __construct(Context $context, array $data = []) {
        parent::__construct($context, $data);
    }


    /**
     * Retrieve country name from ip address
     *
     * @return string
     */
    public function getCountry()
    {

        $clientIp = $this->_request->getClientIp();
        $requestUri = 'http://freegeoip.net/json/' . $clientIp;
        $httpClient = new \Magento\Framework\HTTP\ZendClient($requestUri);
        $response = $httpClient->request('GET')->getBody();
        return json_decode($response, true);
    }
}
