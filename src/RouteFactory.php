<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Router;

/**
 *
 * A factory to create Route objects.
 *
 * @package Aura.Router
 *
 */
class RouteFactory
{
    /**
     *
     * The route class to create.
     *
     * @param string
     *
     */
    protected $class = 'Aura\Router\Route';

    /**
     *
     * The default route specification.
     *
     * @var array
     *
     */
    protected $spec = array(
        'tokens' => array(),
        'server' => array(),
        'method' => array(),
        'accept' => array(),
        'defaults' => array(),
        'secure' => null,
        'wildcard' => null,
        'routable' => true,
        'namePrefix' => null,
        'pathPrefix' => null,
    );

    /**
     *
     * Constructor.
     *
     * @param string $class The route class to create.
     *
     */
    public function __construct($class = 'Aura\Router\Route')
    {
        $this->class = $class;
    }

    /**
     *
     * Returns a new instance of the route class.
     *
     * @param string $path The path for the route.
     *
     * @param string $name The name for the route.
     *
     * @param array $spec The spec for the new instance.
     *
     * @return Route
     *
     */
    public function newInstance($path, $name = null, array $spec = array())
    {
        $spec = array_merge($this->spec, $spec);

        $path = $spec['pathPrefix'] . $path;

        $name = ($spec['namePrefix'] && $name)
              ? $spec['namePrefix'] . '.' . $name
              : $name;

        $class = $this->class;
        $route = new $class($path, $name);
        $route->addTokens($spec['tokens']);
        $route->addServer($spec['server']);
        $route->addMethod($spec['method']);
        $route->addAccept($spec['accept']);
        $route->addDefaults($spec['defaults']);
        $route->setSecure($spec['secure']);
        $route->setWildcard($spec['wildcard']);
        $route->setRoutable($spec['routable']);
        return $route;
    }
}
