<?php

namespace Sheppers\RestDocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ResourceController extends Controller
{
    /**
     * @Route("/resources", name="RestDoc_Resources_getResources")
     * @Method({"GET"})
     */
    public function getResourcesAction(Request $request)
    {
        $resources = $this->getDoctrine()->getManager('describe')
            ->getRepository('SheppersRestDescribeBundle:Resource')
            ->findAll()
        ;

        return $this->render('SheppersRestDocBundle:Resource:getResources.html.twig', array('resources' => $resources));
    }
}
