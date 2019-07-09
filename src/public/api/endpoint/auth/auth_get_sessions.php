<?php
/*
*  ====>
*
*  Get a list of the active sessions for the current user.
*
*  **Request:** GET
*
*  Return value
*    * sessions = An array of sessions.
*
*  <====
*/

namespace pub\api\endpoints\auth;

require_once($_SERVER['DOCUMENT_ROOT'].'/../common/php/Config.php');

use \api\APIEndpoint;

APIEndpoint::GET(
	[
		'APIAuthModule' => [
			'cookie_auth' => FALSE
		],
		'APIRateLimitModule' => []
	],
	function($req, $resp, $module_data) {
		$data = [];
		$user = $module_data['APIAuthModule']['user'];
		$session = $module_data['APIAuthModule']['session'];

		foreach ($user->get_sessions() as $s) {
			$data['sessions'][] = $s->export(FALSE, FALSE);
		}
		return $data;
	}
);
