<?php
namespace TanDinh\FreeGeoIp\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * Default customer account page
     *
     * @return void
     */
    public function execute()
    {
        echo "<pre>";
        print_r("Hello GEO");
        die;
    }
}