<?php
namespace Omnipay\Paymaster\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const ENDPOINT = 'https://paymaster.ru/Payment/Init';

    public function setMerchantId($merchantId)
    {
        return $this->setParameter('merchant_id', $merchantId);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }

    public function setSecretKey($secretKey)
    {
        return $this->setParameter('secret_key', $secretKey);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secret_key');
    }

    public function setHashingAlgorithm($hashingAlgorithm)
    {
        return $this->setParameter('hashing_algorithm', $hashingAlgorithm);
    }

    public function getHashingAlgorithm()
    {
        return $this->getParameter('hashing_algorithm');
    }

    public function getEndpoint()
    {
        return self::ENDPOINT;
    }
}