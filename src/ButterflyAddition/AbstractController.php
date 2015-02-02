<?php

namespace ButterflyAddition;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Butterfly\Component\DI\Container;

abstract class AbstractController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @autowired ["service_container"]
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return EntityManager
     */
    protected function getDoctrine()
    {
        return $this->container->get('bfy_adapter.doctrine.entity_manager');
    }

    /**
     * @param string $entityName
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository($entityName)
    {
        return $this->getDoctrine()->getRepository($entityName);
    }

    /**
     * @param string $view
     * @param array $parameters
     * @param Response $response
     * @return Response
     */
    protected function render($view, array $parameters = array(), Response $response = null)
    {
        $content = $this->renderView($view, $parameters);

        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($content);

        return $response;
    }

    /**
     * @param string $view
     * @param array $parameters
     * @return string
     */
    protected function renderView($view, array $parameters = array())
    {
        return $this->container->get('bfy_adapter.twig')->render($view, $parameters);
    }

    /**
     * @param string         $route         The name of the route
     * @param mixed          $parameters    An array of parameters
     * @param bool|string    $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return RedirectResponse
     */
    protected function redirectByRoute($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->redirectByUrl($this->generateUrl($route, $parameters, $referenceType));
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @param string         $route         The name of the route
     * @param mixed          $parameters    An array of parameters
     * @param bool|string    $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    protected function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->container->get('bfy_plugin.auth.authorization_router')->generateUrl($route, $parameters, $referenceType);
    }

    /**
     * @param string $url
     * @param int $status
     * @return RedirectResponse
     */
    protected function redirectByUrl($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }
}
