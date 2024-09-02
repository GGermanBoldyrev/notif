<?php

namespace interfaces;

use DateTime;
use enums\SenderTypes;
use models\Notify;

interface NotifySendersServiceInterface
{
    /**
    * @param DateTime $dateTime
    * @return array<Notify>
    */
    function getNotSends(DateTime $dateTime): array;

    function setNotificationSended(int $notifyId, SenderTypes $type): void;
}