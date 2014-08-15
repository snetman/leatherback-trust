<?php
namespace Craft;

/**
 * Element locale data record class.
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.records
 * @since     1.0
 */
class ElementLocaleRecord extends BaseRecord
{
	// Public Methods
	// =========================================================================

	/**
	 * @return string
	 */
	public function getTableName()
	{
		return 'elements_i18n';
	}

	/**
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'element' => array(static::BELONGS_TO, 'ElementRecord', 'required' => true, 'onDelete' => static::CASCADE),
			'locale'  => array(static::BELONGS_TO, 'LocaleRecord', 'locale', 'required' => true, 'onDelete' => static::CASCADE, 'onUpdate' => static::CASCADE),
		);
	}

	/**
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('elementId', 'locale'), 'unique' => true),
			array('columns' => array('slug', 'locale')),
			array('columns' => array('uri', 'locale'), 'unique' => true),
			array('columns' => array('enabled')),
		);
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'locale'  => array(AttributeType::Locale, 'required' => true),
			'slug'    => array(AttributeType::String),
			'uri'     => array(AttributeType::Uri, 'label' => 'URI'),
			'enabled' => array(AttributeType::Bool, 'default' => true),
		);
	}
}
