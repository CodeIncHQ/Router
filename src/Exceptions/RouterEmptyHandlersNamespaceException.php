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
// Date:     28/09/2018
// Project:  Router
//
declare(strict_types=1);
namespace CodeInc\Router\Exceptions;
use CodeInc\Router\Resolvers\HandlerResolverInterface;
use Throwable;


/**
 * Class RouterEmptyHandlersNamespaceException
 *
 * @package CodeInc\Router\Exceptions
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
final class RouterEmptyHandlersNamespaceException extends \LogicException implements RouterException
{
    /**
     * @var HandlerResolverInterface
     */
    private $router;

    /**
     * RouterEmptyHandlersNamespaceException constructor.
     *
     * @param HandlerResolverInterface $router
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(HandlerResolverInterface $router, int $code = 0, Throwable $previous = null)
    {
        $this->router = $router;
        parent::__construct(
            "The request handlers namespace can not be empty.",
            $code,
            $previous
        );
    }
}