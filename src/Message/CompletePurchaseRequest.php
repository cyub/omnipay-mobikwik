<?php

namespace Omnipay\Mobikwik\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    public function setRequestParams($value)
    {
        return $this->setParameter('request_params', $value);
    }

    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }

    public function getData()
    {
        return $this->getRequestParams();
    }

    public function generateCheckSum($data)
    {
        $params = ['statuscode', 'orderid', 'amount', 'statusmessage', 'mid', 'refid'];
        return $this->buildCheckSum($data, $params);
    }

    public function sendData($data)
    {
        $data['verify_success'] = isset($data['checksum']) && $data['checksum'] == $this->generateCheckSum($data);
        $data['is_paid'] = $data['verify_success'] && (isset($data['statuscode']) && $data['statuscode'] == 0);
        $data['is_failure'] = isset($data['statuscode']) && $data['statuscode'] != 0;
        $data['is_pending'] = false;
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}