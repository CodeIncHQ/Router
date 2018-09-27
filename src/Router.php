<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE                                               |
// +---------------------------------------------------------------------+
// | Copyright (c) 2018 - Code Inc. SAS - All Rights Reserved.           |
// | Visit https://www.codeinc.fr for more information about licensing.  |
// +---------------------------------------------------------------------+
// | NOTICE:  All information contained herein is, and remains the       |
// | property of Code Inc. SAS. The intellectual and technical concepts  |
// | contained herein are proprietary to Code Inc. SAS are protected by  |
// | trade secret or copyright law. Dissemination of this information or |
// | reproduction of this material is strictly forbidden unless prior    |
// | written permission is obtained from Code Inc. SAS.                  |
// +---------------------------------------------------------------------+
//
// Author:   Joan Fabrégat <joan@codeinc.fr>
// Date:     05/03/2018
// Time:     11:53
// Project:  Router
//
declare(strict_types = 1);
namespace CodeInc\Router;
use Psr\Http\Message\ServerRequestInterface;


/**
 * Class Router
 *
 * @package CodeInc\Router
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class Router implements RouterInterface
{
    /**
     * @var string[]
     */
    private $controllers = [];

    /**
     * Adds a controller.
     *
     * @param string $route URI path (supports shell patterns)
     * @param string $controllerClass
     * @throws RouterException
     */
    public function addRoute(string $route, string $controllerClass):void
    {
        if (!is_subclass_of($controllerClass, ControllerInterface::class)) {
            throw RouterException::notAController($controllerClass);
        }
        $realRoute = strtolower($route);
        if (isset($this->controllers[$realRoute])) {
            throw RouterException::duplicateRoute($route);
        }
        $this->controllers[$realRoute] = $controllerClass;
    }

    /**
     * @inheritdoc
     * @param ServerRequestInterface $request
     * @return ControllerInterface|null
     */
    public function getControllerClass(ServerRequestInterface $request):?string
    {
        $requestRoute = $request->getUri()->getPath();
        foreach ($this->controllers as $route => $controllerClass) {
            if (fnmatch($route, $requestRoute, FNM_CASEFOLD)) {
                return $controllerClass;
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     * @param string $controllerClass
     * @return null|string
     */
    public function getControllerUri(string $controllerClass):?string
    {
        foreach ($this->controllers as $route => $knownControllerClass) {
            if ($controllerClass == $knownControllerClass) {
                return $route;
            }
        }
        return null;
    }
}