## Omnipay gateway for the paymaster

### Payment

```php
$gateway = \Omnipay\Omnipay::create('Paymaster');
$gateway->initialize([
    'merchant_id' => 'YOUR_MERCHANT_ID',
    'secret_key' => 'YOUR_SECRET_KEY',
    'hashing_algorithm' => 'sha256' // Default value
]);
$response = $gateway->purchase([
    'currency' => 'RUB',
    'amount' => '1.00',
    'transactionId' => '123',
    'description' => 'Оплата заказа №123'
])->send();

if ($response->isRedirect()) {
    // Return this response to the user
    $response->getRedirectResponse();
}
```

### Callback
Put this on your callback controller

```php
$gateway = \Omnipay\Omnipay::create('Paymaster');
$gateway->initialize([
    'secret_key' => 'YOUR_SECRET_KEY',
]);

$response = $gateway->completePurchase($_POST)->send();

if ($response->isSuccessful()) {
    // Your order ID
    echo $response->getTransactionId();
    // Transaction ID
    echo $response->getTransactionReference();
}

```