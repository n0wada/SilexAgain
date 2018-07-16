<?php

namespace SilexAgain;

interface SilexAgainEvents
{
    const BEFORE_EVENT = 'SilexAgain.Before';
    const AFTER_EVENT = 'SilexAgain.After';
    const FINISH_EVENT = 'SilexAgain.Finish';
    const AUTH_EVENT = 'SilexAgain.Auth';
    const VIEW_EVENT = 'SilexAgain.View';
    const EXCEPTION_EVENT = 'SilexAgain.Exception';
}