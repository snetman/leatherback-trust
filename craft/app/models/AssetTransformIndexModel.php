<?php
namespace Craft;

/**
 * Class AssetTransformIndexModel
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.models
 * @since     1.0
 */
class AssetTransformIndexModel extends BaseModel
{
	// Public Methods
	// =========================================================================

	/**
	 * Use the folder name as the string representation.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->id;
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'id'           => AttributeType::Number,
			'fileId'       => AttributeType::Number,
			'location'     => AttributeType::String,
			'sourceId'     => AttributeType::Number,
			'fileExists'   => AttributeType::Bool,
			'inProgress'   => AttributeType::Bool,
			'dateIndexed'  => AttributeType::DateTime,
			'dateUpdated'  => AttributeType::DateTime,
			'dateCreated'  => AttributeType::DateTime,
		);
	}
}
