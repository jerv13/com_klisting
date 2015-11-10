<?php
/**
 * @version     1.0.0
 * @package     com_klisting
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jim <jervdesyn@hotmail.com> - https://github.com/jerv13
 */

// No direct access.
defined('_JEXEC') or die;

require_once __DIR__ . '/../../com_content/models/article.php';

/**
 * Klisting model.
 */
class KlistingModelListing extends ContentModelArticle
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_KLISTING';

    /**
     * Method to get a form object.
     *
     * @param   string   $name     The name of the form.
     * @param   string   $source   The form source. Can be XML string if file flag is set to false.
     * @param   array    $options  Optional array of options for the form creation.
     * @param   boolean  $clear    Optional argument to force load a new form.
     * @param   string   $xpath    An optional xpath to search for the fields.
     *
     * @return  mixed  JForm object on success, False on error.
     *
     * @see     JForm
     * @since   12.2
     */
    protected function loadForm($name, $source = null, $options = array(), $clear = false, $xpath = false)
    {
        //var_dump($name, $source = null, $options = array(), $clear = false, $xpath = false);die;
        $source = 'listing';

        // Handle the optional arguments.
        $options['control'] = JArrayHelper::getValue($options, 'control', false);

        // Create a signature hash.
        $hash = md5($source . serialize($options));

        // Check if we can use a previously loaded form.
        if (isset($this->_forms[$hash]) && !$clear)
        {
            return $this->_forms[$hash];
        }

        // Get the form.
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        JForm::addFieldPath(JPATH_COMPONENT . '/models/fields');
        JForm::addFormPath(JPATH_COMPONENT . '/model/form');
        JForm::addFieldPath(JPATH_COMPONENT . '/model/field');

        try
        {
            $form = JForm::getInstance($name, $source, $options, false, $xpath);

            if (isset($options['load_data']) && $options['load_data'])
            {
                // Get the data for the form.
                $data = $this->loadFormData();
            }
            else
            {
                $data = array();
            }

            // Allow for additional modification of the form, and events to be triggered.
            // We pass the data because plugins may require it.
            $this->preprocessForm($form, $data);

            // Load the data into the form after the plugins have operated.
            $form->bind($data);
        }
        catch (Exception $e)
        {
            $this->setError($e->getMessage());

            return false;
        }

        // Store the form for later.
        $this->_forms[$hash] = $form;

        return $form;
    }

    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success.
     *
     * @since   1.6
     */
    public function save($data)
    {
        $data['zip'] = JRequest::getVar('zip', null, 'files', 'array');

        var_dump($data);


        echo('<pre>');

        debug_print_backtrace();die;
        throw new \Exception('test');

        parent::save($data);
    }

    protected function processZipFile()
    {

    }

}
