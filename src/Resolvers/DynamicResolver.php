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
// Date:     24/09/2018
// Project:  Router
//
declare(strict_types=1);
namespace CodeInc\Router\Resolvers;
use CodeInc\Router\ControllerInterface;
use CodeInc\Router\Exceptions\NotAControllerException;
use CodeInc\Router\Exceptions\NotWithinNamespaceException;
use CodeInc\Router\Exceptions\RouterEmptyControllersNamespaceException;
use CodeInc\Router\Exceptions\RouterEmptyUriPrefixException;


/**
 * Class DynamicHandlerResolver
 *
 * @package CodeInc\Router\Resolvers
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class DynamicResolver implements ResolverInterface
{
    /**
     * @var string
     */
    protected $controllersNamespace;

    /**
     * @var string
     */
    protected $uriPrefix;

    /**
     * DynamicResolver constructor.
     *
     * @param string $controllersNamespace
     * @param string $uriPrefix
     */
    public function __construct(string $controllersNamespace, string $uriPrefix)
    {
        if (empty($uriPrefix)) {
            throw new RouterEmptyUriPrefixException($this);
        }
        if (empty($controllersNamespace)) {
            throw new RouterEmptyControllersNamespaceException($this);
        }
        $this->controllersNamespace = $controllersNamespace;
        $this->uriPrefix = $uriPrefix;
    }

    /**
     * @return string
     */
    public function getControllersNamespace():string
    {
        return $this->controllersNamespace;
    }

    /**
     * @return string
     */
    public function getUriPrefix():string
    {
        return $this->uriPrefix;
    }

    /**
     * @inheritdoc
     * @param string $route
     * @return null|string
     */
    public function getControllerClass(string $route):?string
    {
        if (substr($route, 0, strlen($this->uriPrefix)) == $this->uriPrefix) {
            $controllerClass = $this->controllersNamespace.'\\'
                .str_replace('/', '\\', substr($route, strlen($this->uriPrefix)));
            if (class_exists($controllerClass)
                && is_subclass_of($controllerClass, ControllerInterface::class)) {
                return $controllerClass;
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     * @param string $controllerClass
     * @return string
     */
    public function getControllerRoute(string $controllerClass):string
    {
        if (!is_subclass_of($controllerClass, ControllerInterface::class)) {
            throw new NotAControllerException($controllerClass);
        }
        if (!substr($controllerClass, 0, strlen($this->controllersNamespace)) == $controllerClass) {
            throw new NotWithinNamespaceException($controllerClass, $this->controllersNamespace);
        }
        return $this->uriPrefix
            .str_replace('\\', '/',
                substr($controllerClass, strlen($this->controllersNamespace) + 1));
    }
}