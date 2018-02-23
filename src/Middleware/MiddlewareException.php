<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE                                               |
// +---------------------------------------------------------------------+
// | Copyright (c) 2017 - Code Inc. SAS - All Rights Reserved.           |
// | Visit https://www.codeinc.fr for more information about licensing.  |
// +---------------------------------------------------------------------+
// | NOTICE:  All information contained herein is, and remains the       |
// | property of Code Inc. SAS. The intellectual and technical concepts  |
// | contained herein are proprietary to Code Inc. SAS are protected by  |
// | trade secret or copyright law. Dissemination of this information or |
// | reproduction of this material  is strictly forbidden unless prior   |
// | written permission is obtained from Code Inc. SAS.                  |
// +---------------------------------------------------------------------+
//
// Author:   Joan Fabrégat <joan@codeinc.fr>
// Date:     23/02/2018
// Time:     15:01
// Project:  lib-psr15router
//
declare(strict_types = 1);
namespace CodeInc\Router\Middleware;
use CodeInc\Router\RouterLibException;
use Psr\Http\Server\MiddlewareInterface;
use Throwable;


/**
 * Class MiddlewareException
 *
 * @package CodeInc\Router\Middleware
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class MiddlewareException extends RouterLibException {
	/**
	 * @var MiddlewareInterface
	 */
	private $middleware;

	/**
	 * MiddlewareException constructor.
	 *
	 * @param string $message
	 * @param MiddlewareInterface $middleware
	 * @param int|null $code
	 * @param null|Throwable $previous
	 */
	public function __construct(string $message, MiddlewareInterface $middleware, ?int $code = null,
		?Throwable $previous = null)
	{
		$this->middleware = $middleware;
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @return MiddlewareInterface
	 */
	public function getMiddleware():MiddlewareInterface
	{
		return $this->middleware;
	}
}