<?php

namespace Damms005\LaravueMailer\Controllers;

use App\Http\Controllers\Controller;

class LaravueMailerController extends Controller
{
	public function index()
	{
		//paste csv format (first row are placeholders) inside textarea
		//type email template into a second textarea
		//randomly show build email for any of the csv data
		//click send to send them when you're cool
		return view('laravue-mailer::send-customized-email');
	}
}
