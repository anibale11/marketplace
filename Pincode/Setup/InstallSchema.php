<?php

namespace Magentomaster\Pincode\Setup;

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

		$installer->run('create table pincode(id int not null auto_increment, pincode int(12),courier_name varchar(12),city_name varchar(24),state_name varchar(24),state_code varchar(12),cod varchar(10), primary key(id))');


		

		}

        $installer->endSetup();

    }
}