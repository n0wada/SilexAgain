<?php

namespace SilexAgain;

/**
 * Interface BootableProviderInterface
 * @package SilexAgain
 */
interface BootableProviderInterface extends ServiceProviderInterface
{
    /**
     * @param $app ServiceProviderTrait
     */
    public function boot($app);
}
