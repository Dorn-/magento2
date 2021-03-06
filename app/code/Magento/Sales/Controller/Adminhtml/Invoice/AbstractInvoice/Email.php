<?php
/**
 *
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
namespace Magento\Sales\Controller\Adminhtml\Invoice\AbstractInvoice;

/**
 * Class Email
 *
 * @package Magento\Sales\Controller\Adminhtml\Invoice\AbstractInvoice
 */
abstract class Email extends \Magento\Backend\App\Action
{
    /**
     * Check if email sending is allowed for the current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Sales::sales_invoice');
    }

    /**
     * Notify user
     *
     * @return void
     */
    public function execute()
    {
        $invoiceId = $this->getRequest()->getParam('invoice_id');
        if (!$invoiceId) {
            return;
        }
        $invoice = $this->_objectManager->create('Magento\Sales\Model\Order\Invoice')->load($invoiceId);
        if (!$invoice) {
            return;
        }

        $this->_objectManager->create('Magento\Sales\Model\Order\InvoiceNotifier')
            ->notify($invoice);

        $this->messageManager->addSuccess(__('We sent the message.'));
        $this->_redirect(
            'sales/invoice/view',
            array('order_id' => $invoice->getOrder()->getId(), 'invoice_id' => $invoiceId)
        );
    }
}
