<?php 
namespace Bluecom\OrderController\Controller\Index; 

use Magento\Framework\App\Action\Context ;
use Magento\Sales\Model\OrderFactory;

class Index extends \Magento\Framework\App\Action\Action {
    
    protected $_order;
    public function __construct(Context $context, OrderFactory $orderFactory){
        $this->_order = $orderFactory;
        parent::__construct($context);
    }

    public function execute()
    {   
        $id = (int) $this->getRequest()->getParam('orderid');
        $obj_order = $this->_order->create();
        $orderInfo =  array();
        if($id > 0 ) {
            $obj_order->load($id); 
            $orderInfo['status'] = $obj_order->getStatus();
            $orderInfo['total'] = $obj_order->getGrandTotal();
            $items = array();
            foreach ($obj_order->getAllVisibleItems() as $item) {
               $items[] = array(
                        'sku' => $item->getSku(),
                        'item_id' => $item->getId(), 
                        'price' => $item->getPriceInclTax()) ;
            }
            $orderInfo['items'] = $items;
            $orderInfo['total_invoiced'] = $obj_order->getTotalInvoiced();
            $this->getResponse()->setBody(json_encode($orderInfo));  
        } 
        
    }
}