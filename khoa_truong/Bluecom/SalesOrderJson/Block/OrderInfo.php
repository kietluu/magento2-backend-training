<?php

namespace Bluecom\SalesOrderJson\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry as Registry;

class OrderInfo extends \Magento\Framework\View\Element\Template
{
    protected $_coreRegistry;

    public function __construct(Template\Context $context, Registry $registry,array $data)
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        return $this->_coreRegistry->registry('order');
    }
}