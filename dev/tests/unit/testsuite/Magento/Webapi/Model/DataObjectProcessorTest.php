<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Webapi\Model;

use Magento\Webapi\Model\Config as ModelConfig;

class DataObjectProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var ModelConfig
     */
    protected $config;

    protected function setup()
    {
        $objectManager = new \Magento\TestFramework\Helper\ObjectManager($this);
        $this->dataObjectProcessor = $objectManager->getObject('Magento\Webapi\Model\DataObjectProcessor');
        parent::setUp();
    }

    public function testDataObjectProcessor()
    {
        $objectManager =  new \Magento\TestFramework\Helper\ObjectManager($this);
        /** @var \Magento\Webapi\Model\Files\TestDataObject $testDataObject */
        $testDataObject = $objectManager->getObject('Magento\Webapi\Model\Files\TestDataObject');

        $expectedOutputDataArray = [
            'id' => '1',
            'address' => 'someAddress',
            'default_shipping' => 'true',
            'required_billing' => 'false'
        ];

        $testDataObjectType = 'Magento\Webapi\Model\Files\TestDataInterface';
        $outputData = $this->dataObjectProcessor->buildOutputDataArray($testDataObject, $testDataObjectType);
        $this->assertEquals($expectedOutputDataArray, $outputData);
    }
}
