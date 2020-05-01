<?php 

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->addAttribute('catalog_product', 'group_description', array(
    'group'         => 'Product Custom Attributes',
    'label'        => 'Group Description',
    'visible'      => true,
    'required'     => false,
    'searchable'   => true,
    'type'         => 'text',
    'input'        => 'textarea'
));

$installer->endSetup();
