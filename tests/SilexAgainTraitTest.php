<?php

namespace Tests;

use SilexAgain\SilexAgainTrait;
use SilexAgain\Events;

class SilexAgainTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test register method
     */
    public function testRegister()
    {
        /** @var SilexAgainTrait $app */
        $app = $this->getMockForTrait('SilexAgain\SilexAgainTrait');

        $mock = $this->createMock('SilexAgain\ServiceProviderInterface');
        $mock->expects($this->once())->method('register')->with($app);

        $app->register($mock);
    }

    /**
     * test boot method
     */
    public function testBoot()
    {
        /** @var SilexAgainTrait $app */
        $app = $this->getMockForTrait('SilexAgain\SilexAgainTrait');

        $mock = $this->createMock('SilexAgain\BootableProviderInterface');
        $mock->expects($this->once())->method('register')->with($app);
        $mock->expects($this->once())->method('boot')->with($app);

        $app->register($mock);
        $app->boot();
    }

    /**
     * test callback
     */
    public function testOn()
    {
        $is_called = false;
        /** @var SilexAgainTrait $app */
        $app = $this->getMockForTrait('SilexAgain\SilexAgainTrait');

        $app->on(Events::AUTH_EVENT, function () use (&$is_called) {
            $is_called = true;
        });

        $app->dispatch(Events::AUTH_EVENT, []);

        if (!$is_called) $this->fail("event_callback isn't called");
    }

    /**
     * test callback
     */
    public function testOff()
    {
        $is_called = false;
        /** @var SilexAgainTrait $app */
        $app = $this->getMockForTrait('SilexAgain\SilexAgainTrait');

        $listener = function () use (&$is_called) {
            $is_called = true;
        };

        $app->on(Events::AUTH_EVENT, $listener);

        $app->off(Events::AUTH_EVENT);

        $app->dispatch(Events::AUTH_EVENT);

        if ($is_called) $this->fail("event_callback called");

        $app->on(Events::AUTH_EVENT, $listener);

        $app->off(Events::AUTH_EVENT, $listener);

        if ($is_called) $this->fail("event_callback called");
    }

    /**
     * test dispatch a right event
     */
    public function testEvent()
    {
        /** @var SilexAgainTrait $app */
        $app = $this->getMockForTrait('SilexAgain\SilexAgainTrait');

        $app->on(Events::BEFORE_EVENT, function ($app, $phpunit, $array) {
            /** @var \PHPUnit_Framework_TestCase $phpunit */
            $phpunit->assertTrue(method_exists($app, 'register'));
            $phpunit->assertInstanceOf('\PHPUnit_Framework_TestCase', $phpunit);
            $phpunit->assertTrue($array === []);
            $phpunit->fail("called wrong event");
        });

        $app->on(Events::AUTH_EVENT, function ($app, $phpunit, $array) {
            /** @var $phpunit \PHPUnit_Framework_TestCase */
            $phpunit->assertTrue(method_exists($app, 'register'));
            $phpunit->assertInstanceOf('\PHPUnit_Framework_TestCase', $phpunit);
            $phpunit->assertTrue($array === []);
        });

        $app->on(Events::AFTER_EVENT, function ($app, $phpunit, $array) {
            /** @var $phpunit \PHPUnit_Framework_TestCase */
            $phpunit->assertTrue(method_exists($app, 'register'));
            $phpunit->assertInstanceOf('\PHPUnit_Framework_TestCase', $phpunit);
            $phpunit->assertTrue($array === []);
            $phpunit->fail("called wrong event");
        });

        $app->dispatch(Events::AUTH_EVENT, $this, []);
    }

    /**
     * test dispatch a right event
     */
    public function testEventNoArgs()
    {
        /** @var SilexAgainTrait $app */
        $app = $this->getMockForTrait('SilexAgain\SilexAgainTrait');
        $self = $this;

        $app->on(Events::AUTH_EVENT, function ($app) use ($self) {
            $self->assertTrue(method_exists($app, 'register'));
            $self->assertTrue(func_num_args() === 1);
        });

        $app->dispatch(Events::AUTH_EVENT);
    }
}