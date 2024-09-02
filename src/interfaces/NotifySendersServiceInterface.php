<?php

namespace interfaces;

interface NotifySendersService
{
    /**
    * @param DateTime $dateTime
    * @return array<Notify>
    */
    function getNotSends(DateTime $dateTime): array;

    function setNotificationSended(int $notifyId, SenderTypes $type);
}