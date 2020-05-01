<?php 

$installer = $this; 

$installer->startSetup(); 

$table = $installer->getConnection()
    ->newTable($installer->getTable('salesman/salesman'))
    ->addColumn('salesmanId', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Names')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable'  => false,
    ), 'Email');

$installer->getConnection()->createTable($table);
$installer->endSetup();