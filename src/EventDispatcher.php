<?php

namespace SilexAgain;

/**
 * Class EventDispatcher
 * @package SilexAgain
 */
class EventDispatcher
{
    private $app;

    /**
     * @param EventDispatcherTrait $app
     */
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Adds an event listener.
     *
     * @param string $eventName
     * @param callable $listener
     */
    public function on($eventName, $listener)
    {
        call_user_func_array([$this->app, 'on'], func_get_args());
    }

    /**
     * Dispatches an event.
     *
     * @param string $eventName
     * @param array ...$args
     */
    public function dispatch($eventName, $args = [])
    {
        call_user_func_array([$this->app, 'dispatch'], func_get_args());
    }
}