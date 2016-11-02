<?php

namespace CrazyInventor\LaFlash;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// make config file installable
		$this->publishes([
			__DIR__.'/../config/flash.php' => config_path('flash.php'),
		], 'config');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// There can be only 1 flash
		$this->app->singleton('flash', function ($app) {
			return new Flash();
		});
		$this->app->alias('flash', Flash::class);
	}
}
