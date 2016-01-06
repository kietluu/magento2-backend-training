<?php
namespace Bluecom\ExchangeRate\Block;

use Magento\Framework\View\Element\Context as Context;
use Magento\Framework\HTTP\ZendClientFactory as ClientFactory;
use Psr\Log\LoggerInterface as Logger;

class Rate extends \Magento\Framework\View\Element\AbstractBlock
{
    const EXCHANGE_SITE_URL = 'http://api.fixer.io/latest?base=USD';
    protected $_clientFactory;
    protected $_logger;

    /**
     * Rate constructor.
     * @param Context $context
     * @param ClientFactory $clientFactory
     * @param Logger $logger
     * @param array $data
     */
    public function __construct(Context $context, ClientFactory $clientFactory,
                                Logger $logger,array $data)
    {
        $this->_clientFactory = $clientFactory;
        $this->_logger = $logger;
        parent::__construct($context, $data);
    }

    public function _toHtml()
    {
        $client = $this->_clientFactory->create(['uri' => self::EXCHANGE_SITE_URL]);

        try {
            $result = $client->request();

            $rates = json_decode($result->getBody(), true);

            if (isset($rates['rates']['EUR'])) {
                return sprintf('<div style="display: inline-block;">1 USD = %s EUR</div>', $rates['rates']['EUR']);
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }
    }
}