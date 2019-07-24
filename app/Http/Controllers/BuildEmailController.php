<?php

namespace App\Http\Controllers;

class BuildEmailController extends Controller
{
    public function build()
    {
        //paste csv format (first row are placeholers) inside textarea
        //type email template into a second teaxarea
        //randomly show build email for any of the csv data
        //click send to send them when you're cool
        return view('send-customized-email');
    }
}
