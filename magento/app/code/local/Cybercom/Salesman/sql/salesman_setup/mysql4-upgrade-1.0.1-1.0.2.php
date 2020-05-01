<?php 

$installer = $this; 
$installer->startSetup(); 

$address_table = $installer->getConnection()
    ->newTable($installer->getTable('salesman/address'))
    ->addColumn('address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Id')
    ->addColumn('line1', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Address Line 1')
    ->addColumn('line2', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Address Line 2')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'City')
    ->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'State')
    ->addColumn('zip_code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Zip Code')
    ->addColumn('mobileNo', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Mobile No')
    ->addColumn('salesmanId', Varien_Db_Ddl_Table::TYPE_INTEGER, null, 
        array(
        'nullable'  => false,
        'unsigned'  => true,
        ), 'Salesman Id')
    ->addIndex($installer->getIdxName('salesman/address', array('salesmanId')), array('salesmanId'))
    ->addForeignKey(
            $installer->getFkName('salesman/salesman', 'salesmanId', 'salesman/address', 'salesmanId'),'salesmanId',
            $installer->getTable('salesman/salesman'),'salesmanId',
            Varien_Db_Ddl_Table::ACTION_CASCADE,
            Varien_Db_Ddl_Table::ACTION_CASCADE
        );

$installer->getConnection()->createTable($address_table);
$installer->endSetup();