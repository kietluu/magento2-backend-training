<?php

namespace Bluecom\CustomRouter\Controller;

use Magento\Framework\App\RequestInterface as Request;

class CustomRouter implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    public function process(Request $request)
    {
        $path = $request->getPathInfo();
        $arr  = explode('/', trim($path, '/'));

        $module     = isset($arr[0]) ? $arr[0] : '';
        $controller = isset($arr[1]) ? $arr[1] : '';
        $action     = isset($arr[2]) ? $arr[2] : '';

        if($module === 'catalog' && $controller == 'product' && $action == 'view') {
            $request->setModuleName('customrouter')->setControllerName('router')->setActionName('product');
        } 
        elseif($module === 'catalog' && $controller == 'category' && $action == 'view') {
            $request->setModuleName('customrouter')->setControllerName('router')->setActionName('category');
        } 
        else {
            $request->setModuleName('customrouter')->setControllerName('router')->setActionName('other');
        }
        return false;
    }
}