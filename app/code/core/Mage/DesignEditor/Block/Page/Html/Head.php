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
 * @category    Mage
 * @package     Mage_DesignEditor
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Substitution for regular head block
 */
class Mage_DesignEditor_Block_Page_Html_Head extends Mage_Page_Block_Html_Head
{
    /**
     * Block template
     *
     * @var string
     */
    protected $_template = 'Mage_Page::html/head.phtml';

    /**
     * Render HTML for the added head items
     *
     * @return string
     */
    public function getCssJsHtml()
    {
        /** @var $block Mage_DesignEditor_Block_Page_Html_Head_Vde */
        $block = $this->getLayout()->getBlock('vde_head');
        if ($block) {
            // remove all current JS files
            foreach (array_keys($this->_data['items']) as $itemKey) {
                if (strpos($itemKey, 'js/') === 0) {
                    unset($this->_data['items'][$itemKey]);
                }
            }

            // add data from VDE head
            $vdeItems = $block->getData('items');
            $this->_data['items'] = array_merge($this->_data['items'], $vdeItems);
        }

        return parent::getCssJsHtml();
    }
}