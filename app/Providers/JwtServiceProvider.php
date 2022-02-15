<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer;

class JwtServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $configuration = Configuration::forAsymmetricSigner(
            new Signer\Rsa\Sha256(),
            InMemory::file(public_path('jwt/petshop.key')),
            InMemory::file(public_path('jwt/petshop.key.pub'))
        );

        Config::set('jwtConfig', $configuration);
    }
}
