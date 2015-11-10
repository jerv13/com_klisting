<?php
/**
 * @version     1.0.0
 * @package     com_klisting
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jim <jervdesyn@hotmail.com> - https://github.com/jerv13
 */
// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_klisting/assets/css/klisting.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(
        function () {

        }
    );

    Joomla.submitbutton = function (task) {
        if (task == 'listing.cancel') {
            Joomla.submitform(task, document.getElementById('listing-form'));
        }
        else {

            if (task != 'listing.cancel' && document.formvalidator.isValid(document.id('listing-form'))) {

                Joomla.submitform(task, document.getElementById('listing-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_klisting&layout=add'); ?>"
      method="post"
      enctype="multipart/form-data"
      name="adminForm"
      id="listing-form"
      class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_(
            'bootstrap.startTabSet',
            'myTab',
            array('active' => 'general')
        ); ?>

        <?php echo JHtml::_(
            'bootstrap.addTab',
            'myTab',
            'general',
            JText::_('COM_KLISTING_TITLE_LISTING', true)
        ); ?>

        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    <div class="control-group">
                        <div class="control-label">
                            <label id="jform_title-lbl"
                                   for="jform_title"
                                   class="hasTooltip required"
                                   title=""
                                   data-original-title="<strong>Title</strong>">
                                Title
                                <span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input type="text"
                                   name="jform[title]"
                                   id="jform_title"
                                   value=""
                                   class="input-xxlarge input-large-text required"
                                   size="40"
                                   required="required"
                                   aria-required="true">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="control-label">
                            <label id="jform_alias-lbl"
                                   for="jform_alias"
                                   class="hasTooltip"
                                   title=""
                                   data-placement="bottom"
                                   data-original-title="<strong>Alias</strong><br />The Alias will be used in the SEF URL. Leave this blank and Joomla will fill in a default value from the title. This value will depend on the SEO settings (Global Configuration->Site). <br />Using Unicode will produce UTF-8 aliases. You may also enter manually any UTF-8 character. Spaces and some forbidden characters will be changed to hyphens.<br />When using default transliteration it will produce an alias in lower case and with dashes instead of spaces. You may enter the Alias manually. Use lowercase letters and hyphens (-). No spaces or underscores are allowed. Default value will be a date and time if the title is typed in non-latin letters .">
                                Alias</label>
                        </div>
                        <div class="controls">
                            <input type="text"
                                   name="jform[alias]"
                                   id="jform_alias"
                                   value=""
                                   size="40"
                                   placeholder="Auto-generate from title">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="control-label">
                            <label id="jform_date-lbl"
                                   for="jform_date-"
                                   class="hasTooltip"
                                   title=""
                                   data-placement="bottom"
                                   data-original-title="">
                                   Date</label>
                        </div>
                        <div class="controls">
                            <input type="date"
                                   name="jform[date]"
                                   id="jform_date"
                                   value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="control-label">
                            <label id="jform_zip-lbl"
                                   for="jform_zip"
                                   class="hasTooltip"
                                   title=""
                                   data-placement="bottom"
                                   data-original-title="Zip File">
                                Upload</label>
                        </div>
                        <div class="controls">
                            <input type="file"
                                   name="jform[zip]"
                                   id="jform_zip"
                                   value="">
                        </div>
                    </div>
                    <?php //echo $this->form->getInput('alias'); ?>

                    <?php //var_dump($this->form); ?>

                </fieldset>
            </div>
        </div>

        <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value=""/>
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>
