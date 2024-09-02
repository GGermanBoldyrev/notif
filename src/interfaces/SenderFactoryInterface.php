<?php

namespace interfaces;

use enums\SenderTypes;

interface SenderFactoryInterface
{
    function make(SenderTypes $type): SenderNotifyInterface;
}