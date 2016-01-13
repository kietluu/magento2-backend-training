<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 29/12/2015
 * Time: 11:27
 */
namespace BLayouts\ExchangeRate\Block;


class ShowExchangeRate extends \Magento\Framework\View\Element\AbstractBlock
{
    const SOURCE_URL = 'http://api.fixer.io/latest?base=USD';

    /**
     * @var \Magento\Framework\HTTP\ZendClientFactory $clientFactory
     */
    protected $clientFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Magento\Framework\HTTP\ZendClientFactory $clientFactory,
        \Psr\Log\LoggerInterface $logger,
        array $data = []
    )
    {
        $this->clientFactory = $clientFactory;
        $this->_logger = $logger;
        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        $client = $this->clientFactory->create(['uri' => self::SOURCE_URL]);

        try {
            $result = $client->request();
            $rates = json_decode($result->getBody(), true);

            if (isset($rates['rates']['EUR'])) {
                return sprintf('<div style="display: inline-block;color: red;">1 USD = %s EUR</div>', $rates['rates']['EUR']);
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }
    }
}