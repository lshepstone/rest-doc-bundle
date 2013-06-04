<?php

namespace Sheppers\RestDocBundle\Prototype;

use Sheppers\RestDescribeBundle\Entity\Operation;

class ResponsePrototype
{
    protected $operation;

    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
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

        foreach ($this->operation->getResource()->getProperties() as $property) {
                $name = $property->getName();
                $entity[$name] = '{' . $name . '}';
        }

        $body = json_encode($entity);

        return $body;
    }
}
