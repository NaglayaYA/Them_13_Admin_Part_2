<?php
namespace Perspective\Them11ex1\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

use Magento\Framework\Setup\Patch\PatchVersionInterface;

use Magento\Framework\Setup\ModuleDataSetupInterface;

use Perspective\Them11ex1\Model\ContactdetailsFactory;

use Perspective\Them11ex1\Model\ResourceModel\Contactdetails;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    private $contactDetailsFactory;

    private $contactDetailsResource;

    private $moduleDataSetup;

    public function __construct(

        ContactdetailsFactory $contactDetailsFactory,

        Contactdetails $contactDetailsResource,

        ModuleDataSetupInterface $moduleDataSetup

    ) {

        $this->contactDetailsFactory = $contactDetailsFactory;

        $this->contactDetailsResource = $contactDetailsResource;

        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()

    {

        $this->moduleDataSetup->startSetup();
        
        $contactDTO = $this->contactDetailsFactory->create();
       
        
        $contactDTO->setName('Kurito Leman Part 3')
        ->setHours(2)
        ->setDate('2023-06-16 19:00:00')
        ->setCustomer(3)
        ->setDiscount(0.15)
        ->setPrice(60); 

        $this->contactDetailsResource->save($contactDTO);

        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()

    {

        return [];
    }

    public static function getVersion()

    {

        return '1.0.1';
    }

    public function getAliases()


    {

        return [];
    }
}
