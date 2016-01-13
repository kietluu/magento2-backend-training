<?php
namespace BLayouts\BundleBlock\Block;

class Hello extends \Magento\Framework\View\Element\AbstractBlock
{
    protected function _toHtml()
    {
        return '<div style="color: red;">hello world</div>';
    }
}
