<?php
namespace Omnipay\Paymaster;

use Omnipay\Common\AbstractGateway;
use Omnipay\Paymaster\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Paymaster';
    }

    public function getDefaultParameters()
    {
        return [
            'merchant_id' => '',
            'secret_key' => '',
            'hashing_algorithm' => 'sha256'
        ];
    }

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

    /**
     * @param array $options
     * @return PurchaseRequest
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }
}