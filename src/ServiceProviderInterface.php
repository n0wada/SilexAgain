<?php

namespace SilexAgain;

interface ServiceProviderInterface
{
    /**
     * @param $app SilexAgainTrait
     */
    public function register($app);
}
