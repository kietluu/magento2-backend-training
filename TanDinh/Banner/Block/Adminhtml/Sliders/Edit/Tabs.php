<?php
namespace TanDinh\Banner\Block\Adminhtml\Sliders\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        $this->setId('tandinh_banner_sliders_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Slider'));
    }
}
