<?php
/**
 * @version     1.0.0
 * @package     com_klisting
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jim <jervdesyn@hotmail.com> - https://github.com/jerv13
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Listing controller class.
 */
class KlistingControllerListing extends JControllerForm
{
    function __construct() {
        $this->view_list = 'listings';
        parent::__construct();
    }
}
