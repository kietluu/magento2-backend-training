<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 29/12/2015
 * Time: 11:27
 */
namespace Bluecom\IpWithObserver\Block;


class ShowCountry extends \Magento\Framework\View\Element\AbstractBlock
{
	protected $_customerSession;

	public function __construct(
		\Magento\Framework\View\Element\Context $context,
		\Magento\Customer\Model\Session $session,
		array $data = []
	)
	{
		$this->_customerSession = $session;
		parent::__construct($context, $data);
	}

	protected function _toHtml()
	{
		$locationData = $this->_customerSession->getLocationData();
		if (is_object($locationData)) {
			return sprintf('<li class="client-country" style="color: mediumseagreen;"><span>%s</span></li>', $locationData->country_name ? $locationData->country_name : 'Unknown country');
		}
	}
}