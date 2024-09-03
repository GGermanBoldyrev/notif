<?php

namespace interfaces;

use models\Notify;
use models\User;

interface SenderNotifyInterface
{
    function send(Notify $notify): bool;
}