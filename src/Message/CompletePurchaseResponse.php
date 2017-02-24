<?php
namespace Omnipay\Paymaster\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->checkSign();
    }

    public function getTransactionId()
    {
        return $this->getData()['LMI_PAYMENT_NO'];
    }

    public function getTransactionReference()
    {
        return $this->getData()['LMI_SYS_PAYMENT_ID'];
    }

    protected function checkSign()
    {
        $data = $this->getData();

        if (empty($data['LMI_HASH'])) {
            return false;
        }

        $simMode = isset($data['LMI_SIM_MODE']) ? $data['LMI_SIM_MODE'] : '';

        $hashData = $data['LMI_MERCHANT_ID'] . ';' . $data['LMI_PAYMENT_NO'] . ';';
        $hashData .= $data['LMI_SYS_PAYMENT_ID'] . ';' . $data['LMI_SYS_PAYMENT_DATE'] . ';';
        $hashData .= $data['LMI_PAYMENT_AMOUNT'] . ';' . $data['LMI_CURRENCY'] . ';';
        $hashData .= $data['LMI_PAID_AMOUNT'] . ';' . $data['LMI_PAID_CURRENCY'] . ';';
        $hashData .= $data['LMI_PAYMENT_SYSTEM'] . ';' . $simMode . ';';
        $hashData .= $data['secret_key'];

        $hash = base64_encode(hash($data['hashing_algorithm'],  $hashData, true));

        if ($hash != $data['LMI_HASH']) {
            return false;
        }

        $signData = $data['LMI_MERCHANT_ID'];
        $signData .= $data['LMI_PAYMENT_NO'];
        $signData .= $data['LMI_PAYMENT_AMOUNT'];
        $signData .= $data['LMI_CURRENCY'];
        $signData .= $data['secret_key'];

        $sign = base64_encode(hash($data['hashing_algorithm'], $signData, true));
        if ($sign != $data['SIGN']) {
            return false;
        }

        return true;
    }
}