<?php
namespace Craft;

/**
 * Class CheckboxesFieldType
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.etc.fieldtypes
 * @since     1.0
 */
class CheckboxesFieldType extends BaseOptionsFieldType
{
	// Properties
	// =========================================================================

	/**
	 * @var bool
	 */
	protected $multi = true;

	// Public Methods
	// =========================================================================

	/**
	 * Returns the type of field this is.
	 *
	 * @return string
	 */
	public function getName()
	{
		return Craft::t('Checkboxes');
	}

	/**
	 * Returns the field's input HTML.
	 *
	 * @param string $name
	 * @param mixed  $values
	 *
	 * @return string
	 */
	public function getInputHtml($name, $values)
	{
		$options = $this->getTranslatedOptions();

		// If this is a new entry, look for any default options
		if ($this->isFresh())
		{
			$values = array();

			foreach ($options as $option)
			{
				if (!empty($option['default']))
				{
					$values[] = $option['value'];
				}
			}
		}

		return craft()->templates->render('_includes/forms/checkboxGroup', array(
			'name'    => $name,
			'options' => $options,
			'values'  => $values
		));
	}

	// Protected Methods
	// =========================================================================

	/**
	 * Returns the label for the Options setting.
	 *
	 * @return string
	 */
	protected function getOptionsSettingsLabel()
	{
		return Craft::t('Checkbox Options');
	}
}
