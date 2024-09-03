<?php

namespace services;

use DateTime;
use enums\SenderTypes;

class SenderService
{
    public function __construct(
        private NotifyCreatorService        $notifyCreator,
        private UserCreatorService          $userCreator,
        private SenderFactoryService        $senderFactory,
        private NotifySendersService $notifySendersService
    )
    {
        $this->userCreator->create(
            email: "boldyrev_german@mail.ru",
            telegramId: 't.me/ggerman_boldyrev'
        );

        $this->userCreator->create(
            email: "german_for_job@mail.ru",
        );

        $this->notifyCreator->create(
            userId: 0,
            periodMinutes: 5,
            text: "Hello world every 5 minutes for user 1 !!!",
        );

        $this->notifyCreator->create(
            userId: 1,
            periodMinutes: 3,
            text: "Hello every 3 minutes for user 2 !!!"
        );
    }

    public function handle()
    {
        while (true) {
            $dateTimeNow = new DateTime();
            $notifications = $this->notifySendersService->getNotSends($dateTimeNow);
            foreach ($notifications as $notification) {
                foreach (SenderTypes::cases() as $type) {
                    $sender = $this->senderFactory->make($type);
                    $isSended = $sender->send($notification);
                    if ($isSended) {
                        $this->notifySendersService->setNotificationSended($notification->id, $type, $dateTimeNow);
                    }
                }
            }
            sleep(1);
        }
    }
}