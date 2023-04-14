<?php

declare(strict_types=1);

namespace App\Enums;

enum ParamType: int
{
    case TYPE_TEXT = 0;
    case TYPE_SHORT_TEXT = 1;
    case TYPE_DROPDOWN = 2;
    case TYPE_CHECKBOX = 3;
    case TYPE_CHECKBOX_LIST = 4;
    case TYPE_NUMBER = 6;

    public function toLocalizedString(): string
    {
        return match ($this) {
            self::TYPE_TEXT => 'Текст',
            self::TYPE_SHORT_TEXT => 'Строка',
            self::TYPE_DROPDOWN => 'Радио',
            self::TYPE_CHECKBOX => 'Чекбокс',
            self::TYPE_CHECKBOX_LIST => 'Список',
            self::TYPE_NUMBER => 'Число',
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
