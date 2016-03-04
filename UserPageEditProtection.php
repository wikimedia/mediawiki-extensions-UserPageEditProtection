<?php
/**
 * The UserPageEditProtection extension to MediaWiki allows to restrict the edit
 * access to user pages.
 *
 * @link https://www.mediawiki.org/wiki/Extension:UserPageEditProtection Documentation
 * @link https://www.mediawiki.org/wiki/Extension_talk:UserPageEditProtection Support
 * @link https://git.wikimedia.org/summary/mediawiki%2Fextensions%2FUserPageEditProtection.git Source Code
 *
 * @file
 * @ingroup Extensions
 * @package MediaWiki
 *
 * @version 3.0.0 2016-03-04
 *
 * @author Lisa Ridley (lhridley/hoggwild5)
 * @author Eric Gingell (egingell)
 * @author Karsten Hoffmeyer (kghbln)
 *
 * @copyright Copyright (C) 2007, Lisa Ridley
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

// Ensure that the script cannot be executed outside of MediaWiki
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is an extension to MediaWiki and cannot be run standalone.' );
}

// Register extension with MediaWiki
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'UserPageEditProtection',
	'author' => array(
		'Lisa Ridley',
		'Eric Gingell',
		'Karsten Hoffmeyer',
		'...'
		),
	'version' => '3.0.0',
	'url' => 'https://www.mediawiki.org/wiki/Extension:UserPageEditProtection',
	'descriptionmsg' => 'userpageeditprotection-desc',
	'license-name' => 'GPL-2.0+'
);

// Load extension's class
$wgAutoloadClasses['UserPageEditProtection'] = __DIR__ . '/UserPageEditProtection.class.php';

// Register extension messages
$wgMessagesDirs['UserPageEditProtection'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['UserPageEditProtection'] = __DIR__ . '/UserPageEditProtection.i18n.php';

// Add user permission
$wgAvailableRights[] = 'editalluserpages';
$wgGroupPermissions['sysop']['editalluserpages'] = true;

// Register hook
$wgHooks['userCan'][] = 'UserPageEditProtection::onUserCan';
