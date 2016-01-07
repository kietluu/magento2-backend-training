<?php
namespace Bluecom\Freegeoip\Model\ResourceModel;

class Visitor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bluecom_freegeoip_visitor', 'visitor_id');
    }
}