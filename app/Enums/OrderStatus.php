<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Support\Htmlable;

enum OrderStatus: int implements Htmlable
{
    case NEW = 1;
    case PENDING = 2;
    case SUCCESS = 3;
    case DELETED = 4;
    case PAYMENT_WAIT = 5;
    case SENT_TO_DELIVERY = 6;
    case SENT_TO_PICKUP = 7;
    case SENT = 8;
    case DISCARDING = 11;
    case PAYMENT_SUCCESS_WAITING = 12;
    case PAYMENT_SUCCESS = 13;

    public function toHtml()
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::NEW => 'danger',
            self::PENDING => 'info',
            self::SUCCESS => 'success',
            self::DELETED => 'deleted',
            self::PAYMENT_WAIT => 'info',
            self::SENT_TO_DELIVERY => 'primary',
            self::SENT_TO_PICKUP => 'primary',
            self::SENT => 'primary',
            self::DISCARDING => 'primary',
            self::PAYMENT_SUCCESS_WAITING => 'success',
            self::PAYMENT_SUCCESS => 'success',
        };
    }

    public function toLocalizedString(): string
    {
        return match ($this) {
            self::NEW => 'Новый',
            self::PENDING => 'Принят',
            self::SUCCESS => 'Выполнен',
            self::DELETED => 'Удален',
            self::PAYMENT_WAIT => 'Ожидает оплаты',
            self::SENT_TO_DELIVERY => 'Передан в службу доставки',
            self::SENT_TO_PICKUP => 'Передан в пункт самовывоза',
            self::SENT => 'Отправлен',
            self::DISCARDING => 'Отменен',
            self::PAYMENT_SUCCESS_WAITING => 'Оплачен, ожидает отправки',
            self::PAYMENT_SUCCESS => 'Оплачен',
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

    /**
     * Возвращает массив с выполненными заказами
     */
    public static function onlySuccess(): array
    {
        return [
            self::SUCCESS,
            self::SENT_TO_DELIVERY,
            self::SENT_TO_PICKUP,
            self::SENT,
            self::PAYMENT_SUCCESS_WAITING,
            self::PAYMENT_SUCCESS,
        ];
    }
}
