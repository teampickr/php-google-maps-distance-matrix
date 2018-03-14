<?php

namespace TeamPickr\DistanceMatrix\Frameworks\Laravel;

use Illuminate\Support\ServiceProvider;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\PremiumLicense;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class DistanceMatrixServiceProvider extends ServiceProvider
{
    /**
     * Register our packages services.
     */
    public function register()
    {
        $this->app->bind(DistanceMatrix::class, function () {
            return new DistanceMatrix($this->getLicense());
        });
    }

    /**
     * Boot our packages services
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/google.php', 'google');

        $this->publishes([
            __DIR__ . '/google.php' => config_path('google.php'),
        ], 'config');
    }

    /**
     * @return \TeamPickr\DistanceMatrix\Contracts\LicenseContract
     */
    protected function getLicense()
    {
        if (config('google.license_type') === 'premium') {
            return new PremiumLicense(config('google.client_id'), config('google.encryption_key'));
        }

        return new StandardLicense(config('google.key'));
    }
}