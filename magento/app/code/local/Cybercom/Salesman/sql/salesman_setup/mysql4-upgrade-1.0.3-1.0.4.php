<?php 

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->addAttribute('catalog_product', 'bed_size', array(
    'group'         => 'Product Custom Attributes',
    'label'        => 'Bed Size',
    'visible'      => true,
    'required'     => false,
    'type'         => 'text',
    'input'        => 'multiselect',
    'backend'      => 'eav/entity_attribute_backend_array',
));


$tableOptions        = $installer->getTable('eav_attribute_option');
$tableOptionValues   = $installer->getTable('eav_attribute_option_value');

// add options for level of politeness
$attributeId = (int)$setup->getAttribute('catalog_product', 'bed_size', 'attribute_id');
foreach (array('Size 1', 'Size 2') as $sortOrder => $label) {

    // add option
    $data = array(
        'attribute_id' => $attributeId,
        'sort_order'   => $sortOrder,
    );

    $installer->getConnection()->insert($tableOptions, $data);

    // add option label
    $optionId = (int)$installer->getConnection()->lastInsertId($tableOptions, 'option_id');
    $data = array(
        'option_id' => $optionId,
        'store_id'  => 0,
        'value'     => $label,
    );

    $installer->getConnection()->insert($tableOptionValues, $data);

}

$installer->endSetup();
