<?php
namespace App\Providers;

use Kreait\Firebase;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory as FirebaseFactory;
use Illuminate\Support\ServiceProvider;

/**
 * Class FirebaseServiceProvider
 * @package App\Providers
 */
class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Firebase::class, function() {
            $serviceAccountPath = \Config::get('firebase.service_account_path');
            $databaseUri        = \Config::get('firebase.database_uri');

            return (new FirebaseFactory())
                ->withServiceAccount(ServiceAccount::fromJsonFile(base_path($serviceAccountPath)))
                ->withDatabaseUri($databaseUri)
                ->create();
        });

        $this->app->alias(Firebase::class, 'firebase');
    }
}
