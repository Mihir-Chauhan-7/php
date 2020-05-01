<?php 

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->addAttributeGroup('catalog_product', 'Default', 'Product Custom Attributes', 1000);

$setup->addAttribute('catalog_product', 'bed_design', array(
    'group'        => 'Product Custom Attributes',
    'label'        => 'Bed Design',
    'visible'      => true,
    'required'     => false,
    'type'         => 'int',
    'input'        => 'select',
    'source'        => 'eav/entity_attribute_source_table',
));


$tableOptions        = $installer->getTable('eav_attribute_option');
$tableOptionValues   = $installer->getTable('eav_attribute_option_value');

// add options for level of politeness
$attributeId = (int)$setup->getAttribute('catalog_product', 'bed_design', 'attribute_id');
foreach (array('Design 1', 'Design 2') as $sortOrder => $label) {

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
