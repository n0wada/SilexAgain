<?php

namespace SilexAgain;

/**
 * Interface ServiceProviderInterface
 * @package SilexAgain
 */
interface ServiceProviderInterface
{
    /**
     * @param $app ServiceProviderTrait
     */
    public function register($app);
}
