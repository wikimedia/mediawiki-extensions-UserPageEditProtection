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
 * @author Lisa Ridley
 * @author Eric Gingell
 *
 * @copyright Copyright (C) 2007, Lisa Ridley (lhridley)
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
		'...'
		),
	'version' => '2.1.0-alpha',
	'url' => 'https://www.mediawiki.org/wiki/Extension:UserPageEditProtection',
	'descriptionmsg' => 'userpageeditprotection-desc',
	'license-name' => 'GPL-2.0+'
);

// Register extension messages
$wgMessagesDirs['UserPageEditProtection'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['UserPageEditProtection'] = __DIR__ . '/UserPageEditProtection.i18n.php';

// Add user permission
$wgAvailableRights[] = 'editalluserpages';
$wgGroupPermissions['sysop']['editalluserpages'] = true;

// Register hook
$wgHooks['userCan'][] = 'fnUserPageEditProtection';

// Perform action
function fnUserPageEditProtection( $title, $user, $action, &$result ) {
	global $wgOnlyUserEditUserPage;
	$lTitle = explode( '/', $title->getText() );
	if ( !( $action == 'edit' || $action == 'move' ) ) {
		$result = null;
	return true;
        }
	if ( $title->mNamespace !== NS_USER ) {
		$result = null;
		return true;
	}
	if ( $wgOnlyUserEditUserPage ) {
		if ( $user->isAllowed( 'editalluserpages' ) || ( $user->getname() == $lTitle[0] ) ) {
			$result = null;
			return true;
		} else {
			$result = false;
			return false;
		}
	}
	$result = null;
	return true;
}
