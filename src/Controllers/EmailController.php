<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class EmailController extends Controller
{
	/**
	 * Undocumented function
	 *
	 * @param [mixed] $user - \App\User or simply plain email (string)
	 * @param [type] $subject
	 * @param [type] $message
	 * @return void
	 */
	public static function create($user, $subject, $message)
	{
		if (is_null($user)) {
			return response("Error: no user found");
		}

		if (empty($user->email)) {
			return response("Error: no email found for this user");
		}

		$from = env('MAIL_USERNAME');

		SendMailJob::dispatch(new MessageApplicant($user, $from, $subject, $message));

		return response('Successfully sent request for mail delivery', 200);
	}
}
