<?php
namespace Training2\OrderInfo\Controller\Index;

use Magento\Framework\App\Action\Context;

class ResponseAjax extends \Magento\Framework\App\Action\Action
{
    protected $_orderFactory;

    public function __construct(
        Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory
    )
    {
        $this->_orderFactory = $orderFactory;
        parent::__construct($context);
    }

    public function execute()
    {
//        if(!$this->_request->isAjax()){
//            $this->_redirect('*/*/index');
//        }
        $orderId = $this->getRequest()->getParam('id');

        $order = $this->_orderFactory->create();
        $order->load($orderId);

        $orderData = [];

        if ($order->getId()) {
            $orderData['status'] = $order->getStatus();
            $orderData['total'] = $order->getGrandTotal();

            $items = [];
            foreach ($order->getAllVisibleItems() as $item) {
                $items[] = [
                    'sku' => $item->getSku(),
                    'item_id' => $item->getId(),
                    'price' => $item->getPriceInclTax()
                ];
            }
            $orderData['items'] = $items;

            $orderData['total_invoiced'] = $order->getTotalInvoiced();
        }else{
            $orderData['error'] = __('Not exist orderId');
        }

        $this->getResponse()->setBody(json_encode($orderData));
    }
}