<?php 

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->addAttribute('catalog_product', 'map_price', array(
    'group'         => 'Product Custom Attributes',
    'label'        => 'map_price',
    'visible'      => true,
    'required'     => false,
    'searchable'   => true,
    'type'         => 'decimal',
    'input'        => 'price',
    'backend'      => 'catalog/product_attribute_backend_price'
));

$installer->endSetup();
