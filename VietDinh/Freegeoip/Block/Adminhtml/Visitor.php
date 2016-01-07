<?php
namespace Bluecom\Freegeoip\Block\Adminhtml;

class Visitor extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'Bluecom_Freegeoip';
        $this->_headerText = __('Visitor Data');
        $this->_addButtonLabel = __('Add New data');
        parent::_construct();
    }
}