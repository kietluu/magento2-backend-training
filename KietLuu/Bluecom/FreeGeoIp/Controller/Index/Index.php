<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 29/12/2015
 * Time: 10:01
 */
namespace Bluecom\FreeGeoIp\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	/** @var \Magento\Framework\View\Result\PageFactory  */
	protected $resultPageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
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
		return $this->resultPageFactory->create();
	}
}