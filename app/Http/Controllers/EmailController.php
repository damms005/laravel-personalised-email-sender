<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\MessageApplicant;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [mixed] $user - \App\User or simply plain email repreented as string (hence 'mixed' type @signature)
     * @param \App\Company $company
     * @param [type] $subject
     * @param [type] $message
     * @return void
     */
    public static function sendMail($user, \App\Company $company, $subject, $message)
    {
        if (is_null($user)) {
            $error = "Error: no user found for this order";
            Log::info($error);
            Log::info($user);
            exit($error);
        }

        if (!($user)) {
            $error = "Error: no email found for this user";
            Log::info($error);
            Log::info($user);
            exit($error);
        }

        // $from = optional($company->hr_officer)->email ? $company->hr_officer->email : 'hr@schoolserver.com.ng';
        $from = optional($company->hr_officer)->email ? $company->hr_officer->email : env('MAIL_USERNAME', 'admin@hr.deb');

        SendMailJob::dispatch(new MessageApplicant($user, $from, $subject, $message));
        return response('Succesfully sent request for mail delivery', 200);
    }
}
