<?php

namespace Omnipay\Mobikwik;

use Omnipay\Common\AbstractGateway;

class ExpressGateway extends AbstractGateway
{
    public function getMid()
    {
        return $this->getParameter('mid');
    }

    public function setMid($value)
    {
        return $this->setParameter('mid', $value);
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }

    public function setEnvironment($value)
    {
        return $this->setParameter('environment', $value);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Mobikwik\\Message\\PurchaseRequest", $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Mobikwik\\Message\\CompletePurchaseRequest", $parameters);
    }

    public function queryOrder(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Mobikwik\\Message\\QueryOrderRequest", $parameters);
    }

    public function refund(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Mobikwik\\Message\\RefundRequest", $parameters);
    }

    public function getName()
    {
        return 'Mobikwik_Express';
    }
}
   