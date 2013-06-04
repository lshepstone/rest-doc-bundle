<?php

namespace Sheppers\RestDocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sheppers\RestDescribeBundle\Entity\Operation;

class OperationController extends Controller
{
    /**
     * @Route("/resources/{resource}/operations/{operation}", name="RestDoc_Operations_getOperation")
     * @Method({"GET"})
     */
    public function getOperationAction(Request $request, $resource, $operation)
    {
        $operation = $this->getDoctrine()->getManager('describe')
            ->getRepository('SheppersRestDescribeBundle:Operation')
            ->findOneByNameForResource($resource, $operation)
        ;

        return $this->render('SheppersRestDocBundle:Operation:getOperation.html.twig', array(
            'operation' => $operation
        ));
    }
}
