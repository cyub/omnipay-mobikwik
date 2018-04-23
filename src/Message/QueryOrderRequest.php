<?php

namespace Omnipay\Mobikwik\Message;

use Omnipay\Mobikwik\Common\ResponseParser;

class QueryOrderRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('mid', 'orderid');

        $data = [
            'mid' => $this->getMid(),
            'orderid' => $this->getOrderId(),
        ];
        $data['checksum'] = $this->generateCheckSum($data);

        return $data;
    }

    public function generateCheckSum($data)
    {
        $params = ['mid', 'orderid'];
        return $this->buildCheckSum($data, $params);
    }

    public function generateResponseCheckSum($data)
    {
        $params = ['statuscode', 'orderid', 'refid', 'amount', 'statusmessage', 'ordertype'];
        return $this->buildCheckSum($data, $params);
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint('OrderQuery');
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $body = http_build_query($data);
        $response = $this->httpClient->request('POST', $url, $headers, $body);

        $data = (array)ResponseParser::xml($response);
        $data['verify_success'] = isset($data['checksum']) && $data['checksum'] == $this->generateResponseCheckSum($data);
        $data['is_paid'] = $data['verify_success'] == true && (isset($data['statuscode']) && $data['statuscode'] == 0);
        $data['is_failure'] = isset($data['statuscode']) && $data['statuscode'] != 0;
        $data['is_pending'] = false;

        return $this->response = new QueryOrderResponse($this, $data);
    }
}