<?php

namespace Sheppers\RestDocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="RestDocs_Default_index", defaults={"_format": "html"})
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $resources = $this->getDoctrine()->getManager('describe')
            ->getRepository('SheppersRestDescribeBundle:Resource')
            ->findAll()
        ;

        return $this->render('SheppersRestDocBundle:Default:layout.html.twig', array('resources' => $resources));
    }
}
