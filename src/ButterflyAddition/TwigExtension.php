<?php

namespace ButterflyAddition;

use Butterfly\Application\RequestResponse\Routing\IRouter;
use Butterfly\Application\RequestResponse\Routing\IRouterAware;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Twig_Environment;
use Twig_NodeVisitorInterface;

class TwigExtension implements \Twig_ExtensionInterface
{
    /**
     * @var string
     */
    protected $version;

    /**
     * @var UrlGenerator
     */
    protected $urGenerator;

    /**
     * @param string $version
     * @param UrlGenerator $urGenerator
     */
    public function __construct($version, UrlGenerator $urGenerator)
    {
        $this->version     = $version;
        $this->urGenerator = $urGenerator;
    }

    /**
     * Initializes the runtime environment.
     *
     * This is where you can load some file that contains filter functions for instance.
     *
     * @param Twig_Environment $environment The current Twig_Environment instance
     */
    public function initRuntime(Twig_Environment $environment)
    {

    }

    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return array();
    }

    /**
     * Returns the node visitor instances to add to the existing list.
     *
     * @return Twig_NodeVisitorInterface[] An array of Twig_NodeVisitorInterface instances
     */
    public function getNodeVisitors()
    {
        return array();
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array();
    }

    /**
     * Returns a list of tests to add to the existing list.
     *
     * @return array An array of tests
     */
    public function getTests()
    {
        return array();
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('path', array($this, 'generateUrl')),
            new \Twig_SimpleFunction('asset', array($this, 'getAssetUrl')),
        );
    }

    /**
     * @param string $route
     * @param array $parameters
     * @return string
     */
    public function generateUrl($route, $parameters = array())
    {
        return $this->urGenerator->generate($route, $parameters);
    }

    /**
     * @param string $url
     * @param string|null $version
     * @return string
     */
    public function getAssetUrl($url, $version = null)
    {
        if (null === $version && null !== $this->version) {
            $version = $this->version;
        }

        return (null !== $version) ? sprintf('%s?%s', $url, $version) : $url;
    }

    /**
     * Returns a list of operators to add to the existing list.
     *
     * @return array An array of operators
     */
    public function getOperators()
    {
        return array();
    }

    /**
     * Returns a list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals()
    {
        return array();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'butterfly_twig_extensions';
    }
}
