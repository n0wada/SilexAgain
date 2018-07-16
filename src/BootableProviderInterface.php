<?php

namespace SilexAgain;

interface BootableProviderInterface extends ServiceProviderInterface
{
    /**
     * @param $app SilexAgainTrait
     */
    public function boot($app);
}
