<?php
/**
 * @version     1.0.0
 * @package     com_klisting
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jim <jervdesyn@hotmail.com> - https://github.com/jerv13
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::register('KlistingFrontendHelper', JPATH_COMPONENT . '/helpers/klisting.php');

// Execute the task.
$controller = JControllerLegacy::getInstance('Klisting');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
