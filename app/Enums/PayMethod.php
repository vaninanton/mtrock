<?php

declare(strict_types=1);

namespace App\Enums;

enum PayMethod: int
{
    case CASH = 1;
    case BANK_ONLINE = 2;
    case YANDEXMONEY = 3;
    case QIWI = 4;
    case CREDITCARD = 5;
    case SBOL = 6;
    case BANK_ACCOUNT = 7;

    public function toLocalizedString(): string
    {
        return match ($this) {
            self::CASH => 'Наличными',
            self::BANK_ONLINE => 'Банк-онлайн',
            self::YANDEXMONEY => 'Оплата Яндекс.Деньги',
            self::QIWI => 'Оплата QIWI',
            self::CREDITCARD => '​Оплата банковской картой',
            self::SBOL => 'Сбербанк онлайн',
            self::BANK_ACCOUNT => 'Оплата в банке по счету',
        };
    }

    /**
     * Возвращает массив в формате ключ-значение.
     */
    public static function toLocalizedArray(): array
    {
        $items = [];
        foreach (self::cases() as $case) {
            $items[$case->value] = $case->toLocalizedString();
        }

        return $items;
    }
}
