<?php 
namespace Bluecom\OrderInfo\Controller\Index;

use Magento\Sales\Model\OrderFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context; 
 
class Index extends \Magento\Framework\App\Action\Action {

    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory, 
        OrderFactory $orderFactory,
        Registry $registry)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_order = $orderFactory;
        $this->_registry = $registry;
        parent::__construct($context);
    }
 

    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('orderid');
        $flag = $this->getRequest()->getParam('json');
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

            if(isset($flag) && $flag == 1){
                $this->getResponse()->setBody(json_encode($orderInfo));      
            }
            else {
                $this->_registry->register('order', $obj_order);
                $resultPage = $this->resultPageFactory->create();
                return $resultPage;
            }
        }        

    }
}