<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE - CONFIDENTIAL                                |
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
// Date:     11/12/2017
// Time:     16:53
// Project:  lib-router
//
namespace CodeInc\Router\Assets\Interfaces;


/**
 * Interface WebAssetsManagerInterface
 *
 * @package CodeInc\GUI\Assets\Interfaces
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
interface WebAssetsManagerInterface {
	/**
	 * WebAssetsManagerInterface constructor.
	 *
	 * @param string $webAssetsBaseURI
	 */
	public function __construct(string $webAssetsBaseURI);

	/**
	 * @param string $asset
	 * @param string|null $className
	 * @param string|null $baseNamespace
	 * @return string
	 */
	public function getAssetURI(string $asset, string $className = null, string $baseNamespace = null):string;
}