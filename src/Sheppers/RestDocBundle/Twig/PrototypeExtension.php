<?php

namespace Sheppers\RestDocBundle\Twig;

use Sheppers\RestDescribeBundle\Entity\Operation;
use Sheppers\RestDocBundle\Prototype\RequestPrototype;
use Sheppers\RestDocBundle\Prototype\ResponsePrototype;

class PrototypeExtension extends \Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'prototype';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'prototype' => new \Twig_Function_Method($this, 'prototype'),
        );
    }

    /**
     * Creates a RequestPrototype instance from an Operation entity.
     *
     * @param string $type
     * @param Operation $operation
     *
     * @throws \InvalidArgumentException
     *
     * @return RequestPrototype
     */
    public function prototype($type, Operation $operation)
    {
        switch ($type) {
            case 'request':
                return new RequestPrototype($operation);

            case 'response':
                return new ResponsePrototype($operation);

            default:
                throw new \InvalidArgumentException("Prototype type '{$type}' is not supported");
        }
    }
}
