<?php

namespace Damms005\LaravueMailer\Controllers;

use Illuminate\Routing\Controller;

class LaravueMailerController extends Controller
{
	public function index()
	{
		return view('laravue-mailer::send-customized-email');
	}
}
