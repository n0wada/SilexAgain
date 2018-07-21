<?php

namespace SilexAgain;

trait SilexAgainTrait
{
    private $_providers = [];
    private $_listeners = [];

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

    /**
     * Delegates event dispatch.
     *
     * @return EventDispatcher
     */
    public function getEventDispatcher()
    {
        return new EventDispatcher($this);
    }
}