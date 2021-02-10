<?php

namespace Damms005\LaravueMailer;

use Illuminate\Support\ServiceProvider;

class LaravueMailerServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->make('Damms005\LaravueMailer\Controllers\LaravueMailerController');
		$this->loadViewsFrom(__DIR__ . '/../views', 'laravue-mailer');
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		include __DIR__ . '/routes.php';

		$this->publishes([
			__DIR__ . '/../publishable/config/laravel-personalised-email-sender.php'         => config_path('laravel-personalised-email-sender.php'),
			__DIR__ . '/../publishable/js/app.js' => public_path('js/vendor/laravel-personalised-email-sender/app.js'),
		], 'laravel-personalised-email-sender');
	}
}
