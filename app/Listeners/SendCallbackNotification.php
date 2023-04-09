<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\CallbackCreated;
use Telegram\Bot\Laravel\Facades\Telegram;

class SendCallbackNotification
{
    public function handle(CallbackCreated $event): void
    {
        $text = [];
        $text[] = '📲 Запрос на обратный звонок';
        $text[] = 'Имя: '.$event->callback->name;
        $text[] = 'Телефон: <a href="tel:'.$event->callback->phone.'">'.$event->callback->phone.'</a>';
        $text[] = 'Страница: <a href="'.$event->callback->url.'">'.$event->callback->url.'</a>';

        $msg = Telegram::bot()->sendMessage([
            'chat_id' => 131396,
            'parse_mode' => 'HTML',
            'text' => implode(PHP_EOL, $text),
        ]);

        /** @var int|null */
        $messageId = $msg->getMessageId();

        $event->callback->telegram_message_id = $messageId;
        $event->callback->save();
    }
}
