<?php

namespace services;

use interfaces\NotifySendersServiceInterface;
use models\Notify;
use DateTime;

class NotifySendersServiceImpl implements NotifySendersServiceInterface
{
    public function getNotSends(DateTime $dateTime): array
    {
        return Notify::getNotSends($dateTime->format('Y-m-d H:i:s'));
    }

    public function setNotificationSended(int $notifyId, SenderTypes $type) : void
    {
        Notify::setNotificationSended($notifyId);
    }
}