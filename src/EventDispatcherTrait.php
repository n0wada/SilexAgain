<?php

namespace SilexAgain;

/**
 * Trait EventDispatcherTrait
 * @package SilexAgain
 */
trait EventDispatcherTrait
{
    private $_listeners = [];

    /**
     * Adds an event listener.
     *
     * @param string $eventName
     * @param callable $listener
     */
    public function on($eventName, $listener)
    {
        if (!is_callable($listener)) {
            throw new \InvalidArgumentException('$listener must be a callable');
        }

        $this->_listeners[$eventName][] = $listener;
    }

    /**
     * remove event listeners.
     *
     * @param string $eventName
     * @param callable $listener
     */
    public function off($eventName, $listener = null)
    {
        if (empty($this->_listeners[$eventName])) {
            return;
        }

        if ($listener === null) {
            unset($this->_listeners[$eventName]);

        } else {
            foreach ($this->_listeners[$eventName] as $k => $v) {
                if ($v === $listener) {
                    unset($this->_listeners[$eventName][$k]);
                    return;
                }
            }
        }
    }

    /**
     * Dispatches an event.
     *
     * @param string $eventName
     * @param mixed ...$args
     */
    public function dispatch($eventName, $args = [])
    {
        if (isset($this->_listeners[$eventName])) {

            // $args = [$this, $arg1, $arg2...]
            $args = array_replace(func_get_args(), [$this]);

            foreach ($this->_listeners[$eventName] as $listener) {
                call_user_func_array($listener, $args);
            }
        }
    }
}