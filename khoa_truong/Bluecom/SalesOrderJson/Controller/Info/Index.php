<?php

namespace Bluecom\SalesOrderJson\Controller\Info;

use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Registry as Registry;
use Magento\Framework\View\Result\PageFactory as PageFactory;
use Magento\Framework\Model\OrderFactory as OrderFactory;
use Magento\Framework\Controller\Result\ForwardFactory as ForwardFactory;

class Index extends \Bluecom\SalesOrder\Controller\Info\Index
{

    protected $_coreRegistry;

    protected $_resultForwardFactory;

    protected $_resultPageFactory;
    /**
     * Index constructor.
     * @param Context $context
     * @param OrderFactory $orderFactory
     * @param Registry $registry
     * @param PageFactory $pageFactory
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(Context $context, OrderFactory $orderFactory,Registry $registry,
                                PageFactory $pageFactory, ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context, $orderFactory);
    }

    public function execute()
    {
        if(($json = $this->getRequest()->getParam('json')) && $json == 1)
        {
            return parent::execute();
        }
        $orderId = $this->getRequest()->getParam('orderID');
        $order = $this->_orderFactory->create();
        $order->load($orderId);
        if(!$order->getId()) {
            $resultForward = $this->_resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        $resultPage = $this->_resultPageFactory->create();
        $this->_coreRegistry->register('order', $order);

        return $resultPage;
    }
}