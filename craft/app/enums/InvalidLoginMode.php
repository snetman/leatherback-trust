<?php
namespace Craft;

/**
 * The InvalidLoginMode class is an abstract class that defines all of the invalid login modes that are available in
 * Craft when a user has tried to incorrectly log into their account
 * {@link http://buildwithcraft.com/docs/config-settings#maxInvalidLogins maxInvalidLogins} times.
 *
 * This class is a poor man's version of an enum, since PHP does not have support for native enumerations.
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.enums
 * @since     1.0
 */
abstract class InvalidLoginMode extends BaseEnum
{
	// Constants
	// =========================================================================

	const Cooldown = 'cooldown';
	const Lockout  = 'lockout';
}
