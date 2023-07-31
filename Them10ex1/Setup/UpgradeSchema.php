<?php
namespace Perspective\Them10ex1\Setup;



use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
      
        $installer->startSetup();
      
        if(version_compare($context->getVersion(), '1.1.0', '<')) {
         $installer->getConnection()->addColumn(
          $installer->getTable( 'perspective_them10ex1_post' ),
          'text_rev',
          [
           'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
           'nullable' => true,
           'length' => '64k',
           'comment' => 'Text Rev',
           'after' => 'product_id'
          ]
         );
        }
      
        $installer->endSetup();
       } 

}

