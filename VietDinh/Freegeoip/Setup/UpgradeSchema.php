<?php

namespace Bluecom\Freegeoip\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
     public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'bluecom_freegeoip_data'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('bluecom_freegeoip_visitor')
        )->addColumn(
            'visitor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Visitor ID'
        )->addColumn(
            'visitor_ip',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            20,
            ['nullable' => true],
            'IP Address'
        )->addColumn(
            'country_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            5,
            ['nullable' => true],
            'Country Code'
        )->addColumn(
            'country_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            200,
            ['nullable' => true],
            'Country Name'
        )->addColumn(
            'region_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            ['nullable' => true, 'default' => null],
            'Region Code'
        )->addColumn(
            'region_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Region Name'
        )->addColumn(
            'city',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            200,
            [],
            'City'
        )->addColumn(
            'zip_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            5,
            [],
            'Zip Code'
        )->addColumn(
            'time_zone',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            [],
            'Time Zone'
        )->addColumn(
            'latitude',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            [],
            'Latitude'
        )->addColumn(
            'longitude',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            [],
            'Logititude'
        )->addColumn(
            'metro_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            [],
            '>Metro code'
        )->addColumn(
            'browser',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            250,
            [],
            'Browser'
        )->addColumn(
            'os',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            250,
            [],
            'Operator System'
        )->setComment(
            'Bluecom Visitor Data Table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
