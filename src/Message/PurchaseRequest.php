<?php
namespace Omnipay\Paymaster\Message;


class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');

        $signData = $this->getMerchantId();
        $signData .= $this->getTransactionId();
        $signData .= $this->getAmount();
        $signData .= $this->getCurrency();
        $signData .= $this->getSecretKey();

        $sign = base64_encode(hash($this->getHashingAlgorithm(), $signData, true));

        return [
            'LMI_MERCHANT_ID' => $this->getMerchantId(),
            'LMI_PAYMENT_AMOUNT' => $this->getAmount(),
            'LMI_CURRENCY' => $this->getCurrency(),
            'LMI_PAYMENT_NO' => $this->getTransactionId(),
            'LMI_PAYMENT_DESC' => $this->getDescription(),
            'SIGN' => $sign
        ];
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}