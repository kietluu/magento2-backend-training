<?php

namespace Bluecom\CustomRouter\Controller;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\View\Result\PageFactory as PageFactory;

class Router extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultLayout = $this->resultPageFactory->create();
        return $resultLayout;
    }
}
