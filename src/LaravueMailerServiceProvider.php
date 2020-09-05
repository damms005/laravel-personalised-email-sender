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
			__DIR__ . '/../config/laravue-mailer.php' => config_path('laravue-mailer.php'),
			__DIR__ . '/../vue-cli-app/dist/assets/' => public_path('vendor/laravue-mailer/'),
		], 'laravue-mailer');
	}
}
