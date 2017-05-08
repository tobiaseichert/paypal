<?php
/**
 * This file is part of OXID eSales PayPal module.
 *
 * OXID eSales PayPal module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales PayPal module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales PayPal module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2017
 */

namespace OxidEsales\PayPalModule\Tests\Integration;

class OrderFinalizationTest extends \OxidEsales\TestingLibrary\UnitTestCase
{

    public function providerFinalizeOrder_TransStatusNotChange()
    {
        return array(
            array('Pending', \OxidEsales\PayPalModule\Model\Order::OEPAYPAL_TRANSACTION_STATUS_NOT_FINISHED),
            array('Failed', \OxidEsales\PayPalModule\Model\Order::OEPAYPAL_TRANSACTION_STATUS_NOT_FINISHED),
            array('Complete', \OxidEsales\PayPalModule\Model\Order::OEPAYPAL_TRANSACTION_STATUS_OK)
        );
    }

    /**
     * After order is finalized and PayPal order status is not 'complete',
     * order transaction status should also stay 'NOT FINISHED'.
     *
     * @dataProvider providerFinalizeOrder_TransStatusNotChange
     *
     * @param string $payPalReturnStatus
     * @param string $transactionStatus
     */
    public function testFinalizeOrder_TransactionStatus($payPalReturnStatus, $transactionStatus)
    {
        $this->getSession()->setVariable('sess_challenge', '_testOrderId');
        $this->getSession()->setVariable('paymentid', 'oxidpaypal');

        /** @var \OxidEsales\PayPalModule\Model\Basket $basket */
        $basket = oxNew(\OxidEsales\PayPalModule\Model\Basket::class);

        $paymentGateway = $this->getPaymentGateway($payPalReturnStatus);

        /** @var \OxidEsales\PayPalModule\Model\Order|\PHPUnit_Framework_MockObject_MockObject $order */
        $order = $this->getMock(
            \OxidEsales\PayPalModule\Model\Order::class,
            array('_getGateway', '_sendOrderByEmail', 'validateOrder'));
        $order->expects($this->any())->method('_getGateway')->will($this->returnValue($paymentGateway));

        $order->setId('_testOrderId');
        $order->finalizeOrder($basket, $this->getUser());

        $updatedOrder = oxNew(\OxidEsales\Eshop\Application\Model\Order::class);
        $updatedOrder->load('_testOrderId');
        $this->assertEquals($transactionStatus, $updatedOrder->getFieldData('oxtransstatus'));
        $updatedOrder->delete();
    }

    /**
     * Returns Payment Gateway with mocked PayPal call. Result returns provided return status.
     *
     * @param string $payPalReturnStatus
     *
     * @return \OxidEsales\PayPalModule\Model\PaymentGateway
     */
    protected function getPaymentGateway($payPalReturnStatus)
    {
        /** @var \OxidEsales\PayPalModule\Model\Response\ResponseDoExpressCheckoutPayment $result */
        $result = oxNew(\OxidEsales\PayPalModule\Model\Response\ResponseDoExpressCheckoutPayment::class);
        $result->setData(array('PAYMENTINFO_0_PAYMENTSTATUS' => $payPalReturnStatus));

        /** @var \OxidEsales\PayPalModule\Core\PayPalService|\PHPUnit_Framework_MockObject_MockObject $service */
        $service = $this->getMock(\OxidEsales\PayPalModule\Core\PayPalService::class, array('doExpressCheckoutPayment'));
        $service->expects($this->any())->method('doExpressCheckoutPayment')->will($this->returnValue($result));

        /** @var \OxidEsales\PayPalModule\Model\PaymentGateway $payPalPaymentGateway */
        $payPalPaymentGateway = oxNew(\OxidEsales\Eshop\Application\Model\PaymentGateway::class);
        $payPalPaymentGateway->setPayPalCheckoutService($service);

        return $payPalPaymentGateway;
    }

    /**
     * @return \OxidEsales\PayPalModule\Model\User
     */
    protected function getUser()
    {
        /** @var \OxidEsales\PayPalModule\Model\User $user */
        $user = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
        $user->load('oxdefaultadmin');

        return $user;
    }
}
