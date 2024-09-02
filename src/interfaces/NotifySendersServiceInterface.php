<?php

namespace interfaces;

interface NotifySendersServiceInterface
{
    /**
    * @param DateTime $dateTime
    * @return array<Notify>
    */
    function getNotSends(DateTime $dateTime): array;

    function setNotificationSended(int $notifyId, SenderTypes $type): void;
}