<?php
namespace Craft;

/**
 * Widget base class.
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.widgets
 * @since     1.0
 */
abstract class BaseWidget extends BaseSavableComponentType implements IWidget
{
	// Properties
	// =========================================================================

	/**
	 * The type of component this is.
	 *
	 * @var string
	 */
	protected $componentType = 'Widget';

	/**
	 * Whether users should be able to select more than one of this widget type.
	 *
	 * @var bool
	 */
	protected $multi = true;

	/**
	 * How many columns the widget should span, if there's enough room.
	 *
	 * @var bool
	 */
	protected $colspan = 1;

	// Public Methods
	// =========================================================================

	/**
	 * Returns whether this component should be selectable when choosing a component of this type.
	 *
	 * @return bool
	 */
	public function isSelectable()
	{
		if ($this->multi || !craft()->dashboard->doesUserHaveWidget($this->getClassHandle()))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns the widget's title.
	 *
	 * @return string
	 */
	public function getTitle()
	{
		// Default to the widget name
		return $this->getName();
	}

	/**
	 * Returns the widget's colspan.
	 *
	 * @return int
	 */
	public function getColspan()
	{
		return $this->colspan;
	}

	/**
	 * Returns the widget's body HTML.
	 *
	 * @return string|false
	 */
	public function getBodyHtml()
	{
		return '<div style="margin: 0 -30px -30px;">' .
				'<img style="display: block; width: 100%;" src="'.UrlHelper::getResourceUrl('images/prg.jpg').'">' .
			'</div>';
	}
}
