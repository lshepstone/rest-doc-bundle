<?php

namespace Sheppers\RestDocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use dflydev\markdown\MarkdownParser;

class PageController extends Controller
{
    /**
     * @Route("/", name="RestDoc_Pages_getPages")
     * @Method({"GET"})
     */
    public function getPagesAction(Request $request)
    {
        return $this->getPageAction($request, 'index');
    }

    /**
     * @Route("/{page}", name="RestDoc_Pages_getPage")
     * @Method({"GET"})
     */
    public function getPageAction(Request $request, $page)
    {
        $file = $this->container->getParameter('sheppers_rest_doc.doc.path') . '/' . $page . '.md';
        if (false === is_file($file)) {
            throw $this->createNotFoundException("Page '{$page}' was not found at '{$file}'");
        }

        $markdownParser = new MarkdownParser();

        return $this->render('SheppersRestDocBundle:Page:getPage.html.twig', array(
            'content' => $markdownParser->transformMarkdown(file_get_contents($file))
        ));
    }
}
