<?php 

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->addAttribute('catalog_product', 'mpn', array(
    'group'         => 'Product Custom Attributes',
    'label'        => 'Mpn',
    'visible'      => true,
    'required'     => false,
    'searchable'   => true,
    'type'         => 'varchar',
    'input'        => 'text'
));

$installer->endSetup();
