<?php

namespace Bluecom\Freegeoip\Block;

use Magento\Framework\View\Element\Context as Context;
use Magento\Customer\Model\Session as Session;

class Visitor extends \Magento\Framework\View\Element\AbstractBlock
{
    protected $_customerSession;

    public function __construct(Context $context, Session $session,array $data)
    {
        $this->_customerSession = $session;
        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        $visitorData = $this->_customerSession->getVisitorData();
        if(is_object($visitorData)) {
            return sprintf('<div style="display: inline-block; padding-right: 50px;">%s</div>', $visitorData->country_name ? $visitorData->country_name : 'Viet Nam');
        }
    }
}
