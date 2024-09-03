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
        return $this->notify->getNotSends($dateTime->format('Y-m-d H:i:s'));
    }

    public function setNotificationSended(int $notifyId, SenderTypes $type) : void
    {
        $this->notify->setNotificationSended($notifyId, $type);
    }
}