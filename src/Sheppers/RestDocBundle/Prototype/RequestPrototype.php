<?php

namespace Sheppers\RestDocBundle\Prototype;

use Sheppers\RestDescribeBundle\Entity\Operation;

class RequestPrototype
{
    protected $operation;

    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function getMethod()
    {
        return $this->operation->getMethod();
    }

    public function getUri()
    {
        return $this->operation->getUri();
    }

    public function getHeaders()
    {
        return array(
            'Content-Type' => 'application/json'
        );
    }

    public function getBody()
    {
        $entity = array();

        foreach ($this->operation->getParameters() as $parameter) {
            if ('entity' == $parameter->getLocation()) {
                $name = $parameter->getName();
                $entity[$name] = '{' . $name . '}';
            }
        }

        $body = json_encode($entity);

        return $body;
    }
}
