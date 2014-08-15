<?php
namespace Craft;

/**
 * The class name is the UTC timestamp in the format of mYYMMDD_HHMMSS_migrationName
 */
class m140401_000008_fullpath_to_path extends BaseMigration
{
	/**
	 * Any migration code in here is wrapped inside of a transaction.
	 *
	 * @return bool
	 */
	public function safeUp()
	{
		Craft::log('Converting fullPath to path in table assetfolders.', LogLevel::Info, true);
		if (craft()->db->columnExists('assetfolders', 'fullPath'))
		{
			$this->renameColumn('assetfolders', 'fullPath', 'path');
			Craft::log('Succesfully converted fullPath to path in table assetfolders.', LogLevel::Info, true);
		}
		else
		{
			Craft::log('Column already converted.', LogLevel::Info, true);
		}

		return true;
	}
}
