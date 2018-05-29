<?php

namespace Omnipay\Mobikwik\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

Abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $productionEndpoint = 'https://walletapi.mobikwik.com';
    protected $testEndpoint = 'https://test.mobikwik.com';

    protected $methods = [
        'Purchase' => '/wallet',
        'OrderQuery' => '/checkstatus',
        'Refund'  => '/walletrefund'
    ];

    public function getEndPoint($type = null)
    {
        if ($this->getEnvironment() == 'production') {
            $endpoint = $this->productionEndpoint;
        } else {
            $endpoint = $this->testEndpoint;
        }
        
        return  $type ? $endpoint . $this->methods[$type] : $endpoint;
    }

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

    public function getMerchantname()
    {
        return $this->getParameter('merchantname');
    }

    public function setMerchantname($value)
    {
        return $this->setParameter('merchantname', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderid');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderid', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getTelephone()
    {
        return $this->getParameter('cell');
    }

    public function setTelephone($value)
    {
        return $this->setParameter('cell', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getRedirectUrl()
    {
        return $this->getParameter('redirecturl');
    }

    public function setRedirectUrl($value)
    {
        return $this->setParameter('redirecturl', $value);
    }

    public function getShowMobile()
    {
        return $this->getParameter('showmobile');
    }

    public function setShowMobile($value)
    {
        return $this->setParameter('showmobile', $value);
    }

    public function getVersion()
    {
        return $this->getParameter('version');
    }

    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }

    public function buildCheckSum($data, $params)
    {
        $content = '';
        while($key = array_shift($params)) {
            $content .= isset($data[$key]) ? '\'' . $data[$key] . '\'' : '';
        }

        $checksum = hash_hmac('sha256', $content, $this->getKey());
        return $checksum;
    }
}