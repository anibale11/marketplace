<?php

namespace Magentomaster\Marketplace\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), '1.0.0') < 0){
            $installer->run('create table vendor_order_items (
                id int NOT NULL autoincrement,
                sku varchar(50) NOT NULL,
                amount decimal(12),
                commision decimal(12),
                tdr decimal(12),
                qty int,
                order_id int,
                seller_id int,
                order_status varchar(12),
                shipment_amount decimal(12),
                order_date datetime,
                PRIMARY KEY (id)
            )');
            $installer->run('create table vendor_details(
                id int not null autoincrement,
                total_pending decimal(12),
                total_invoice decimal(12),
                total_ship decimal(12),
                total_creditmemo decimal(12),
                total_paid decimal(12),
                total_remaining decimal(12),
                total_tdr decimal(12),
                total_commission decimal(12),
                total_ship_charges decimal(12),
                seller_id int,
                PRIMARY KEY(id)
            )');
            $installer->run('create table vendors(
                id int not null auto_increment, 
                name varchar(100),
                street_address varchar(150), 
                city varchar(50),
                pincode varchar(50), 
                country varchar(50),
                email varchar(50), 
                phoneno varchar(50),
                created_date DATETIME DEFAULT NOW(),
                gst_no varchar(50),status int, 
                comission int, 
                shop_url varchar(200),
                bank_details varchar(400),
                store_name varchar(200), 
                primary key(id))');
		}
        $installer->endSetup();
    }
}