<?php
namespace Craft;

craft()->requireEdition(Craft::Pro);

/**
 * Class UserPermission_UserGroupRecord
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.records
 * @since     1.0
 */
class UserPermission_UserGroupRecord extends BaseRecord
{
	// Public Methods
	// =========================================================================

	/**
	 * @return string
	 */
	public function getTableName()
	{
		return 'userpermissions_usergroups';
	}

	/**
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'permission' => array(static::BELONGS_TO, 'UserPermissionRecord', 'required' => true, 'onDelete' => static::CASCADE),
			'group'      => array(static::BELONGS_TO, 'UserGroupRecord',      'required' => true, 'onDelete' => static::CASCADE),
		);
	}

	/**
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('permissionId', 'groupId'), 'unique' => true),
		);
	}
}
