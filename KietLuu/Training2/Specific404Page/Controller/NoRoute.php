<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 12/01/2016
 * Time: 18:43
 */
namespace Training2\Specific404Page\Controller;

use Magento\Framework\App\ResponseInterface;

class NoRoute extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultLayout = $this->resultPageFactory->create();
        $resultLayout->setStatusHeader(404, '1.1', 'Not 6 Found');
        $resultLayout->setHeader('Status', '401 File not Found');
        return $resultLayout;
    }
}