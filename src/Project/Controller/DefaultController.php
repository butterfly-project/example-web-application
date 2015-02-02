<?php

namespace Project\Controller;

use ButterflyAddition\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @service project.controller.default
 */
class DefaultController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $name = $request->get('name', 'World');

        return $this->render('default/index.html.twig', array(
            'name' => $name,
        ));
    }
}
