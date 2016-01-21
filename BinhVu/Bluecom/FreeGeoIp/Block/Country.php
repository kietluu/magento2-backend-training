<?php
namespace Bluecom\FreeGeoIp\Block;

class Country extends \Magento\Framework\View\Element\Template
{
    protected $_country;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Bluecom\FreeGeoIp\Model\Country $country,
        array $data = []
    )
    {
        $this->_country = $country;
        parent::__construct($context, $data);
    }

    public function getCountry(){
        return $this->_country->getCountry();
    }
}