<?php namespace Ksungcaya\Phpass;

use App\User;
use Illuminate\Support\ServiceProvider;
use Ksungcaya\Phpass\Auth\PhpassUserProvider;
use Ksungcaya\Phpass\Hashing\PasswordHash;
use Ksungcaya\Phpass\Hashing\PhpassHasher;

class PhpassServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        $hasher = new PasswordHash(8, false);
        $this->app['auth']->extend('phpass', function() use ($hasher)
        {
           return new PhpassUserProvider($hasher, new User);
        });
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('hash', function()
        {
            return new PhpassHasher;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}
}