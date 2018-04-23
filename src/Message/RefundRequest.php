<?php

namespace Omnipay\Mobikwik\Message;

use Omnipay\Mobikwik\Common\ResponseParser;

class RefundRequest extends AbstractRequest
{
    public function getPartial()
    {
        return $this->getParameter('ispartial');
    }

    public function setPartial($value)
    {
        return $this->setParameter('ispartial', $value);
    }

    public function getData()
    {
        $this->validate('mid', 'orderid', 'amount');

        $data = [
            'mid' => $this->getMid(),
            'txid' => $this->getOrderId(),
            'amount' => $this->getAmount(),
            'email' => $this->getEmail(),
            'ispartial' => $this->getPartial()
        ];
        $data = array_filter($data, 'strlen');
        $data['checksum'] = $this->generateCheckSum($data);

        return $data;
    }

    protected function generateCheckSum($data)
    {
        $params = ['mid', 'txid', 'amount', 'email'];
        return $this->buildCheckSum($data, $params);
    }

    public function sendData($data)
    {
        $uri = $this->getEndpoint('Refund');
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $body = http_build_query($data);

        $response = $this->httpClient->request('POST', $uri, $headers, $body);

        $data = (array)ResponseParser::xml($response);
        $data['verify_success'] = true;
        $data['is_paid'] = $data['verify_success'] == true && (isset($data['statuscode']) && $data['statuscode'] == 0);
        $data['is_failure'] = isset($data['statuscode']) && $data['statuscode'] != 0;
        $data['is_pending'] = false;

        return $this->response = new RefundResponse($this, $data);
    }

}