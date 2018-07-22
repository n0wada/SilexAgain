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
        $this->app->on($eventName, $listener);
    }

    /**
     * remove event listeners.
     *
     * @param string $eventName
     * @param callable $listener
     */
    public function off($eventName, $listener = null)
    {
        $this->app->off($eventName, $listener);
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