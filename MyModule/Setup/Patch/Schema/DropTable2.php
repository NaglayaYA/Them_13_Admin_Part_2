<?php

namespace Perspective\MyModule\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;

use Magento\Framework\Setup\ModuleDataSetupInterface;

class DropTable2 implements SchemaPatchInterface
{

    private $moduleDataSetup;



    public function __construct(

        ModuleDataSetupInterface $moduleDataSetup

    ) {

        $this->moduleDataSetup = $moduleDataSetup;
    }



    public static function getDependencies()

    {

        return [];
    }



    public function getAliases()

    {

        return [];
    }
    public function apply()
    {

        $this->moduleDataSetup->startSetup();



        $this->moduleDataSetup->getConnection()->dropTable(

            $this->moduleDataSetup->getTable('intray_table1')

        );



        $this->moduleDataSetup->endSetup();
    }
    
}
