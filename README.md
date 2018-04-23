# Omnipay: Mobikwik

**Mobikwik driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Mobikwik support for Omnipay.

## 用法

### 发起交易 
```php
$gateway = Omnipay::create('Mobikwik_Express');
$gateway->setMid('MBK9002');
$gateway->setKey('xxxxx');
$gateway->setEnvironment('test');


$params = [
	'email' => "7291994120@nocash.mobikwik.com",
	'orderId' => 'order' . time(),
	'amount' => 0.01,
	'redirecturl' => "http://example.com/callback",
	'showmobile' => 'true',
	'version' => 2,
];


$response = $gateway->purchase($params)->send();
$response->redirect();
```

### 交易通知
```php
$gateway->setMid('MBK9002');
$gateway->setKey('xxxxx');
$gateway->setEnvironment('test');

$response = $gateway->completePurchase(['request_params' => $_REQUEST ])->send();
if ($response->isPaid()) { // 成功
...
} elseif ($response->isFailure()) { // 失败
...
} else { // 进行中
...
}
```

### 订单查询
```php
$gateway->setMid('MBK9002');
$gateway->setKey('xxxxx');
$gateway->setEnvironment('test');

$response = $gateway->queryOrder(['orderId' => 'xxx'])->send();
if ($response->isPaid()) {
...
} elseif ($response->isFailure()) {
...
} else {
...
}
```


### 发起退款
```php
$gateway = Omnipay::create('Mobikwik_Express');

$gateway->setMid('MBK9002');
$gateway->setKey('xxxxx');
$gateway->setEnvironment('test');
$params = [
	'orderId' => 'order0011521618722233',
	'amount' => 0.01
];

$response = $gateway->refund($params)->send();
if ($response->isPaid()) { // 成功
...
} elseif ($response->isFailure()) { // 失败
...
} else { // 进行中
...
}
```