<?php
namespace BLayouts\OrderInfo\Controller\Info;

use Magento\Framework\App\Action\Context;

class Index extends \Training2\OrderInfo\Controller\Index\ResponseAjax
{
    protected $_coreRegistry;

    protected $_resultForwardFactory;

    protected $_resultPageFactory;

    public function __construct
    (
        Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->_coreRegistry = $registry;
        $this->_resultPageFactory = $pageFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $orderFactory);
    }

    public function execute()
    {
        if (($json = $this->getRequest()->getParam('json')) && $json == 1) {
            return parent::execute();
        }
        $orderId = $this->getRequest()->getParam('id');
        $order = $this->_orderFactory->create();
        $order->load($orderId);

        if (!$order->getId()) {
            $resultForward = $this->_resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }

        $resultPage = $this->_resultPageFactory->create();
        $this->_coreRegistry->register('order', $order);

        return $resultPage;
    }
}