<?php

namespace Sheppers\RestDocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
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

        $this->forward403UnlessGranted($operation->getRoles());

        return $this->render('SheppersRestDocBundle:Operation:getOperation.html.twig', array(
            'operation' => $operation
        ));
    }

    public function forward403UnlessGranted($roles)
    {
        if (empty($roles)) {
            return;
        }

        foreach ($roles as $role) {
            if (false !== $this->get('security.context')->isGranted($role)) {
                return;
            }
        }

        throw new AccessDeniedException();
    }
}
