<?php
namespace Bluecom\OrderInfo\Block;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class OrderInfo extends \Magento\Framework\View\Element\Template
{
    public function __construct( Context $context, Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        return $this->_coreRegistry->registry('order');
    }
}