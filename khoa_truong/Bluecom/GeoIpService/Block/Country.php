<?php

namespace Bluecom\GeoIpService\Block;

use Magento\Framework\View\Element\Context as Context;
use Magento\Customer\Model\Session as Session;

class Country extends \Magento\Framework\View\Element\AbstractBlock
{
    protected $_customerSession;

    public function __construct(Context $context, Session $session,array $data)
    {
        $this->_customerSession = $session;
        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        $locationData = $this->_customerSession->getLocationData();
        if(is_object($locationData)) {
            return sprintf('<div style="display: inline-block; padding-right: 50px;">%s</div>', $locationData->country_name ? $locationData->country_name : 'Vietnam');
        }
    }
}
