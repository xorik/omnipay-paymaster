<?php
namespace Omnipay\Paymaster\Message;


class CompletePurchaseRequest extends AbstractRequest
{
    protected $data;

    public function initialize(array $parameters = array())
    {
        $this->data = $parameters;
        return parent::initialize($parameters);
    }

    public function getData()
    {
        return $this->data;
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}