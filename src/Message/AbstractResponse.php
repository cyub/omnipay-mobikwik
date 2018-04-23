<?php

namespace Omnipay\Mobikwik\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

Abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * verify sign
     *
     * @return boolean
     */
    public function isVerifySuccess()
    {
        if (isset($this->data['verify_success'])) {
            return $this->data['verify_success'];
        }
    }

    public function isSuccessful()
    {
        if (isset($this->data['verify_success'])) {
            return $this->data['verify_success'];
        }
    }

    /**
     * success
     *
     * @return boolean
     */
    public function isPaid()
    {
        if (isset($this->data['is_paid'])) {
            return $this->data['is_paid'];
        }
    }

    /**
     * failure
     *
     * @return boolean
     */
    public function isFailure()
    {
        if (isset($this->data['is_failure'])) {
            return $this->data['is_failure'];
        }
    }

    /**
     * processing
     *
     * @return boolean
     */
    public function isPending()
    {
        if (isset($this->data['is_pending'])) {
            return $this->data['is_pending'];
        }
    }

    /**
     * status code
     *
     * @return string
     */
    public function getStatusCode()
    {
        if (isset($this->data['statuscode'])) {
            return $this->data['statuscode'];
        }
    }

    /**
     * trade amount
     */
    public function getPaidAmount()
    {
        if (isset($this->data['amount'])) {
            return $this->data['amount'];
        }
    }

    /**
     * trade order id
     *
     * @return string
     */
    public function getOrderId()
    {
        if (isset($this->data['orderid'])) {
            return $this->data['orderid'];
        }
    }

    /**
     * payment gateway transaction id
     */
    public function getPaymentOrderId()
    {
        if (isset($this->data['refid'])) {
            return $this->data['refid'];
        }
    }
}