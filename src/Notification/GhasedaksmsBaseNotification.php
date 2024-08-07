<?php

namespace Ghasedaksms\GhasedaksmsLaravel\Notification;

use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsMessage;
use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsVerifyLookUp;
use Illuminate\Notifications\Notification;

class GhasedaksmsBaseNotification extends Notification
{
    public function via($notifiable): array
    {
        return ['ghasedaksms'];
    }

    public function toGhasedaksms($notifiable): GhasedaksmsMessage|GhasedaksmsVerifyLookUp
    {
        return new GhasedaksmsMessage();
    }

    public function toArray($notifiable): array
    {
        return [

        ];
    }
}
