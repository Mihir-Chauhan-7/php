<?php 

$installer = $this; 

$installer->startSetup(); 

$table = $installer->getConnection()
    ->newTable($installer->getTable('vendor/vendor'))
    ->addColumn('vendor_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Names');

// $installer->run("
//         DROP TABLE IF EXISTS {$this->getTable('Vendor/Vendor')};
//         CREATE TABLE {$this->getTable('Vendor/Vendor')} (
//           `vendor_id` int(11) unsigned NOT NULL auto_increment,
//           `name` text NOT NULL,
//           PRIMARY KEY (`vendor_id`)
//         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$installer->getConnection()->createTable($table);

$installer->endSetup();