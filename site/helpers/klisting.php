<?php

/**
 * @version     1.0.0
 * @package     com_klisting
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jim <jervdesyn@hotmail.com> - https://github.com/jerv13
 */
defined('_JEXEC') or die;

class KlistingFrontendHelper
{
	

	/**
	 * Get an instance of the named model
	 *
	 * @param string $name
	 *
	 * @return null|object
	 */
	public static function getModel($name)
	{
		$model = null;

		// If the file exists, let's
		if (file_exists(JPATH_SITE . '/components/com_klisting/models/' . strtolower($name) . '.php'))
		{
			require_once JPATH_SITE . '/components/com_klisting/models/' . strtolower($name) . '.php';
			$model = JModelLegacy::getInstance($name, 'KlistingModel');
		}

		return $model;
	}
}
