<?php

namespace Bluecom\SalesOrder\Controller\Info;

use Magento\Framework\App\Action\Context as Context;
use Magento\Sales\Model\OrderFactory as OrderFactory;
use Magento\Framework\App\ResponseInterface;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $_orderFactory;

    /**
     * Initialize dependencies.
     *
     * @param Context $context
     * @param OrderFactory $orderFactory
     */
    public function __construct(Context $context, OrderFactory $orderFactory)
    {
        $this->_orderFactory = $orderFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $orderId = $this->getRequest()->getParam('orderID');

        $order = $this->_orderFactory->create();
        $order->load($orderId);
        $orderData = [];
        if($order->getId()) {
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
            }

            $this->getResponse()->setBody(json_encode($orderData));
        }
    }
}