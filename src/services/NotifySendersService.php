<?php

namespace services;

use interfaces\NotifySendersServiceInterface;
use models\Notify;
use DateTime;
use enums\SenderTypes;

class NotifySendersService implements NotifySendersServiceInterface
{
    private Notify $notify;

    public function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }

    public function getNotSends(DateTime $dateTime): array
    {
        return $this->notify->getNotSends($dateTime);
    }

    public function setNotificationSended(int $notifyId, DateTime $dateTime) : void
    {
        $this->notify->setNotificationSended($notifyId, $dateTime);
    }
}