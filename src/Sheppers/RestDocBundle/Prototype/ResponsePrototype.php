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

    public function getStatusLine()
    {
        $code = '200';
        $phrase = 'OK';
        $responses = $this->operation->getResponses();
        if (count($responses)) {
            reset($responses);
            $code = $responses[0]->getCode();
            $phrase = $responses[0]->getMessage();
        }

        return "HTTP/1.1 {$code} {$phrase}";
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
