<?php

namespace interfaces;

interface SenderNotify
{
    function send(Notify $notify): bool;
}