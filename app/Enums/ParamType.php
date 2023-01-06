<?php

namespace App\Enums;

enum ParamType: int
{
    case TYPE_TEXT = 0;
    case TYPE_SHORT_TEXT = 1;
    case TYPE_DROPDOWN = 2;
    case TYPE_CHECKBOX = 3;
    case TYPE_CHECKBOX_LIST = 4;
    case TYPE_NUMBER = 6;
    case TYPE_FILE = 7;
}
