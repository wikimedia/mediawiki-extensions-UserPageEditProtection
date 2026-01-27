<?php

/**
 * UserPageEditProtection
 *
 * @file
 *
 * @ingroup Extensions
 *
 * @license GPL-2.0-or-later
 */

namespace MediaWiki\Extension\UserPageEditProtection;

use MediaWiki\Permissions\Hook\GetUserPermissionsErrorsHook;

class UserPageEditProtection implements GetUserPermissionsErrorsHook {

	/** @inheritDoc */
	public function onGetUserPermissionsErrors( $title, $user, $action, &$result ) {
		global $wgOnlyUserEditUserPage;

		if (
			$wgOnlyUserEditUserPage &&
			( $action === 'edit' || $action === 'move' ) &&
			$title->getNamespace() === NS_USER &&
			!$user->isAllowed( 'editalluserpages' ) &&
			!$title->isSamePageAs( $user->getUserPage() )
		) {
			// TODO: This really should return a message
			$result = false;
			return false;
		}
		return true;
	}
}
