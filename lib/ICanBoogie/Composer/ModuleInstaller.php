<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ICanBoogie\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class ModuleInstaller extends LibraryInstaller
{
	const PACKAGE_PREFIX = 'module-';

	/**
	 * {@inheritDoc}
	 */
	public function getInstallPath(PackageInterface $package)
	{
		$name = $package->getPrettyName();
		$name = basename($name);

		if (strpos($name, self::PACKAGE_PREFIX) !== 0)
		{
			throw new \InvalidArgumentException
			(
				'Unable to install module, ICanBoogie module should always start their package name with "' . self::PACKAGE_PREFIX . '"'
			);
		}

		$module_id = strtr(substr($name, strlen(self::PACKAGE_PREFIX)), '-', '.');

		return ($this->vendorDir ? $this->vendorDir . '/' : '') . 'icanboogie-modules/' . $module_id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function supports($packageType)
	{
		return 'icanboogie-module' === $packageType;
	}
}