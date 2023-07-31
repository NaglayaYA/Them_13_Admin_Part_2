<?php
namespace Perspective\Them10ex1\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
 {
  $installer = $setup;
  $installer->startSetup();
  if (!$installer->tableExists('perspective_them10ex1_post')) {
   $table = $installer->getConnection()->newTable(
    $installer->getTable('perspective_them10ex1_post')
   )
    ->addColumn(
     'review_id',
     \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
     null,
     [
      'identity' => true,
      'nullable' => false,
      'primary'  => true,
      'unsigned' => true,
     ],
     'Review ID'
    )
    ->addColumn(
     'product_id',
     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
     255,
     ['nullable => false'],
     'Product ID'
    )
    ->addColumn(
        'data_rev',
        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
        null,
        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
        'Data Rev'
        )
    ->addColumn(
     'name_cus',
     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
     '64k',
     [],
     'Customer name'
    )
    ->addColumn(
     'email',
     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
     255,
     [],
     'Customer email'
    )
    
    ->setComment('Post Table');
   $installer->getConnection()->createTable($table);

   $installer->getConnection()->addIndex(
    $installer->getTable('perspective_them10ex1_post'),
    $setup->getIdxName(
     $installer->getTable('perspective_them10ex1_post'),
     ['product_id','name_cus','email'],
     \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
    ),
    ['product_id','name_cus','email'],
    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
   );
  }
  $installer->endSetup();
 }
}
