<?php
namespace Craft;

/**
 * Interface IWidget
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.widgets
 * @since     1.0
 */
interface IWidget extends ISavableComponentType
{
	// Private Methods
	// =========================================================================

	/**
	 * @return string
	 */
	public function getTitle();

	/**
	 * @return string
	 */
	public function getBodyHtml();
}
