<?php

namespace interfaces;

use models\Notify;

interface SenderNotifyInterface
{
    function send(Notify $notify): bool;
}