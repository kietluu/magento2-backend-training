<?php
namespace Bluecom\Freegeoip\Model\ResourceModel\Visitor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'visitor_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bluecom\Freegeoip\Model\Visitor', 'Bluecom\Freegeoip\Model\ResourceModel\Visitor');
        $this->_map['fields']['visitor_id'] = 'main_table.visitor_id';
    }

    /**
     * Prepare page's statuses.
     * Available event cms_page_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}