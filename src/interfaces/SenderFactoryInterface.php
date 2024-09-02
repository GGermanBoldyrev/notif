<?php

namespace interfaces;

interface SenderFactory
{
    function make(SenderTypes $type): SenderNotify;
}