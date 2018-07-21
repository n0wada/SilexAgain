<?php

namespace SilexAgain;

/**
 * Trait ServiceProviderTrait
 * @package SilexAgain
 */
trait ServiceProviderTrait
{
    private $_providers = [];

    /**
     * Registers a service provider.
     *
     * @param ServiceProviderInterface $provider
     */
    public function register(ServiceProviderInterface $provider)
    {
        $this->_providers[] = $provider;
        $provider->register($this);
    }

    /**
     * Boots all service providers.
     *
     * @return self $this
     */
    public function boot()
    {
        foreach ($this->_providers as $provider) {
            if ($provider instanceof BootableProviderInterface) {
                $provider->boot($this);
            }
        }

        return $this;
    }
}