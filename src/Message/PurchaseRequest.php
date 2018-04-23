<?php

namespace Omnipay\Mobikwik\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('mid', 'orderid', 'amount', 'redirecturl');

        $data = [
            'mid' => $this->getMid(),
            'orderid' => $this->getOrderId(),
            'amount' => $this->getAmount(),
            'cell' => $this->getTelephone(),
            'email' => $this->getEmail(),
            'redirecturl' => $this->getRedirectUrl(),
            'merchantname' => $this->getMerchantname(),
            'showmobile' => $this->getShowMobile(),
            'version' => $this->getVersion()
        ];
        $data = array_filter($data, 'strlen');

        $data['checksum'] = $this->generateCheckSum($data);

        return $data;
    }

    public function generateCheckSum($data)
    {
        $params = ['cell', 'email', 'amount', 'orderid', 'redirecturl', 'mid'];
        return $this->buildCheckSum($data, $params);
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
} 