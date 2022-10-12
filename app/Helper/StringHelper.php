<?php

namespace App\Helper;

class StringHelper
{
    public static function getLettersOnly($str): string|null
    {
        return preg_replace('/[^a-zA-Z]+/', '', $str);
    }

    public static function cleanHTML($html): string
    {
        $items = [
            "\xC2\xA0" => ' ' // replace &nbsp; source:https://stackoverflow.com/a/33019796
        ];

        foreach ($items as $search => $replace) {
            $html = str_replace($search, $replace, $html);
        }

        return $html;
    }

    public static function unformatNumber($formattedNumber): string
    {
        return str_replace(['.', ','], ['', '.'], $formattedNumber);
    }
}
