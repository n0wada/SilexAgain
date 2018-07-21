<?php

namespace SilexAgain;

/**
 * Interface Events
 * @package SilexAgain
 */
interface Events
{
    const BEFORE_EVENT = 'SilexAgain.Before';
    const AFTER_EVENT = 'SilexAgain.After';
    const FINISH_EVENT = 'SilexAgain.Finish';
    const AUTH_EVENT = 'SilexAgain.Auth';
    const CONTROLLER_EVENT = 'SilexAgain.Controller';
    const VIEW_EVENT = 'SilexAgain.View';
    const REQUEST_EVENT = 'SilexAgain.Request';
    const RESPONSE_EVENT = 'SilexAgain.Response';
    const EXCEPTION_EVENT = 'SilexAgain.Exception';
}