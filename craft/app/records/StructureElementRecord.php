<?php
namespace Craft;

/**
 * Class StructureElementRecord
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.records
 * @since     2.0
 */
class StructureElementRecord extends BaseRecord
{
	// Public Methods
	// =========================================================================

	/**
	 * @return string
	 */
	public function getTableName()
	{
		return 'structureelements';
	}

	/**
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'structure' => array(static::BELONGS_TO, 'StructureRecord', 'required' => true, 'onDelete' => static::CASCADE),
			'element'   => array(static::BELONGS_TO, 'ElementRecord', 'onDelete' => static::CASCADE),
		);
	}

	/**
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('structureId', 'elementId'), 'unique' => true),
			array('columns' => array('root')),
			array('columns' => array('lft')),
			array('columns' => array('rgt')),
			array('columns' => array('level')),
		);
	}

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return array(
			'nestedSet' => 'app.extensions.NestedSetBehavior',
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
			'root'  => array(AttributeType::Number, 'column' => ColumnType::Int,      'unsigned' => true),
			'lft'   => array(AttributeType::Number, 'column' => ColumnType::Int,      'unsigned' => true, 'null' => false),
			'rgt'   => array(AttributeType::Number, 'column' => ColumnType::Int,      'unsigned' => true, 'null' => false),
			'level' => array(AttributeType::Number, 'column' => ColumnType::SmallInt, 'unsigned' => true, 'null' => false),
		);
	}
}
