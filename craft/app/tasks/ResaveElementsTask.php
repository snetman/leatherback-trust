<?php
namespace Craft;

/**
 * Resave Elements Task
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.tasks
 * @since     2.0
 */
class ResaveElementsTask extends BaseTask
{
	// Properties
	// =========================================================================

	/**
	 * @var
	 */
	private $_elementType;

	/**
	 * @var
	 */
	private $_localeId;

	/**
	 * @var
	 */
	private $_elementIds;

	// Public Methods
	// =========================================================================

	/**
	 * Returns the default description for this task.
	 *
	 * @return string
	 */
	public function getDescription()
	{
		$elementType = craft()->elements->getElementType($this->getSettings()->elementType);

		return Craft::t('Resaving {type}', array(
			'type' => StringHelper::toLowerCase($elementType->getName())
		));
	}

	/**
	 * Gets the total number of steps for this task.
	 *
	 * @return int
	 */
	public function getTotalSteps()
	{
		$settings = $this->getSettings();

		// Let's save ourselves some trouble and just clear all the caches for this element type
		craft()->templateCache->deleteCachesByElementType($settings->elementType);

		// Now find the affected element IDs
		$criteria = craft()->elements->getCriteria($settings->elementType, $settings->criteria);
		$criteria->offset = null;
		$criteria->limit = null;
		$criteria->order = null;

		$this->_elementType = $criteria->getElementType()->getClassHandle();
		$this->_localeId = $criteria->locale;
		$this->_elementIds = $criteria->ids();

		return count($this->_elementIds);
	}

	/**
	 * Runs a task step.
	 *
	 * @param int $step
	 *
	 * @return bool
	 */
	public function runStep($step)
	{
		$element = craft()->elements->getElementById($this->_elementIds[$step], $this->_elementType, $this->_localeId);

		if (!$element || craft()->elements->saveElement($element, false))
		{
			return true;
		}
		else
		{
			$error = 'Encountered the following validation errors when trying to save '.strtolower($element->getElementType()).' element "'.$element.'" with the ID "'.$element->id.'":';

			foreach ($element->getAllErrors() as $attributeError)
			{
				$error .= "\n - {$attributeError}";
			}

			return $error;
		}
	}

	// Protected Methods
	// =========================================================================

	/**
	 * Defines the settings.
	 *
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'elementType' => AttributeType::String,
			'criteria'    => AttributeType::Mixed,
		);
	}
}
