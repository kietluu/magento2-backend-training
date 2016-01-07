<?php
namespace Bluecom\Freegeoip\Model;

class Visitor extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bluecom\Freegeoip\Model\ResourceModel\Visitor');
    }
}